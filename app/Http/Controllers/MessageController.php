<?php

namespace App\Http\Controllers;
use App\Models\Message;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Message::create($request->only([
            'name',
            'email',
            'subject',
            'message'
        ]));

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
