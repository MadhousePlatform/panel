<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @param  int  $per_page
     * @param  int  $page
     * @return Response
     */
    public function index(int $per_page = 25, int $page = 1): Response
    {
        $users = User::paginate($per_page);
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
     * @param  int  $id
     * @return Response
     */
    public function edit(int $id): Response
    {
        return Inertia::render('Admin/User/Edit', ['id' => $id]);
    }
}
