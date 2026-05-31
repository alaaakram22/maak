<?php

namespace App\Http\Controllers;
use App\Models\Message;

use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index()
    {
        $messages = Message::latest()->get();

        return view('Admin.allmessages', compact('messages'));
    }

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
            'message',
            'status' => 'pending',
        ]));

        return back()->with('success', 'Your message has been sent successfully!');
    }

    public function updateStatus(Request $request, Message $message)
{
    $request->validate([
        'status' => 'required|in:pending,in_progress,resolved'
    ]);

    $message->update([
        'status' => $request->status
    ]);

    return back()->with('success', 'Complaint status updated successfully.');
}
}