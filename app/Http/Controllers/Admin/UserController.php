<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return Response
     */
    public function index(): Response
    {
        $users = User::with('admin')->paginate(10);

        activity('admin')
            ->causedBy(auth()->user())
            ->log('viewed user index');

        return Inertia::render('Admin/User/Index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Admin/User/Create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $uuid
     * @return Response
     */
    public function edit(string $uuid): Response
    {
        return Inertia::render('Admin/User/Edit', ['uuid' => $uuid]);
    }
}
