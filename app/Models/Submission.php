<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Submission
 */
class Submission extends Model
{
    use SoftDeletes;

    protected $casts = [
        'json' => 'array'
    ];
}
