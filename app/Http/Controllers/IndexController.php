<?php
declare(strict_types=1);

namespace App\Http\Controllers;

/**
 * Class IndexController
 */
class IndexController extends Controller
{
    /**
     * Return basic index view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }
}
