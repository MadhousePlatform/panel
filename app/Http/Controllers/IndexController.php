<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class IndexController extends Controller
{
    /**
     * If the user is authenticated, redirect them to Dashboard otherwise show the Index page.
     * @return Response|RedirectResponse
     */
    public function __invoke(): Response|RedirectResponse
    {
        return Inertia::render('Index');
    }
}
