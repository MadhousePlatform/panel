<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class NodeController extends Controller
{
    /**
     * Display a listing of the nodes.
     *
     * @return Response
     */
    public function index(): Response
    {
        activity('admin')
            ->causedBy(auth()->user())
            ->log('viewed node index');

        return Inertia::render('Admin/Nodes/Index', []);
    }
}
