<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DiscordController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        return redirect()->to(config('services.discord.invite_link'));
    }
}
