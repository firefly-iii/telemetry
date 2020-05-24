<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Log;
use Ramsey\Uuid\Provider\Node\RandomNodeProvider;
use Ramsey\Uuid\Uuid;

/**
 * Class TelemetryController
 */
class TelemetryController extends Controller
{
    /**
     * Take what is offered and that must sometimes be enough.
     *
     * Store whatever valid JSON the user submitted, and store it for later processing.
     *
     * Also store the user agent (which contains the Firefly III version).
     *
     * @param Request $request
     *
     * @throws \JsonException
     * @return JsonResponse
     */
    public function submit(Request $request): JsonResponse
    {
        $nodeProvider = new RandomNodeProvider();
        $userAgent    = $request->userAgent();
        $uuid         = Uuid::uuid1($nodeProvider->getNode());
        Log::info(sprintf('Now receiving submission for uuid %s and user agent "%s".', $uuid, $userAgent));

        /*
         * Basic check if the user agent is allowed. This won't actually stop any bad actors but maybe some bots are discouraged.
         */
        if (!$this->uaAllowed($userAgent)) {
            Log::error(sprintf('%s: User agent "%s" is not allowed.', $uuid, $userAgent));

            return response()->json(['uuid' => $uuid], 403);
        }

        /*
         * Take the body, if its body is valid JSON. Assumes header is Content-Type = application/json
         */
        $body = $request->all();
        if ([] === $body || !is_array($body)) {
            Log::error(sprintf('%s: Body is empty array or not content-type header.', $uuid));

            return response()->json(['uuid' => $uuid], 400);
        }

        // validate body content:
        if (false === $this->validateBody($body)) {
            Log::error('validateBody says false.');

            return response()->json(['uuid' => $uuid], 400);
        }
        /*
         * Store whatever the user submitted as a new entry.
         */
        $submission             = new Submission;
        $submission->uuid       = $uuid;
        $submission->user_agent = $userAgent;
        $submission->json       = $body;
        try {
            $submission->save();
        } catch (QueryException $e) {
            Log::error(sprintf('%s: Query exception: %s', $uuid, $e->getMessage()));
            Log::error(sprintf('%s: Body:', $uuid), $body);

            return response()->json(['uuid' => $uuid], 500);
        }

        return response()->json(['uuid' => $uuid], 200);
    }

    /**
     * @param string $userAgent
     *
     * @return bool
     */
    private function uaAllowed(string $userAgent): bool
    {
        $agents = config('telemetry.allowed_ua');

        return Str::contains($userAgent, $agents);
    }

    /**
     * Pretty basic check. Each entry should have some keys.
     *
     * @param array $body
     */
    private function validateBody(array $body): bool
    {
        $fields = ['installation_id', 'collected_at', 'type', 'key', 'value'];
        $looped = false;
        foreach ($body as $index => $row) {
            $looped = true;
            foreach ($fields as $field) {
                if (!isset($row[$field])) {
                    Log::error(sprintf('Body contains no field for "%s" in row %d.', $field, $index), $body);

                    return false;
                }
            }
        }
        if (false === $looped) {
            Log::error('No entries in submission.');

            return false;
        }

        return true;
    }
}
