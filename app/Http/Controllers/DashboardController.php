<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->limit(3)->get();
        return view('dashboard', [
            'messages' => $messages
        ]);
    }
}
