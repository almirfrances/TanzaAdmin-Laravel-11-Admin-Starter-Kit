<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;


class MessagesController extends Controller
{
    public function index()
    {
        $messages = Message::paginate(12);

        $openedMessagesCount = Message::where('is_opened', true)->count();
        $unreadMessagesCount = Message::where('is_opened', false)->count();
        $totalMessagesCount = Message::count();

        return view('admin.messages.index', compact('messages', 'openedMessagesCount', 'unreadMessagesCount', 'totalMessagesCount'));
    }

    public function show(Message $message)
{
    if (!$message->is_opened) {
        $message->is_opened = true;
        $message->save();
    }

    return view('admin.messages.show', compact('message'));
}


public function markAllAsRead()
{
    Message::where('is_opened', false)->update(['is_opened' => true]);

    sweetalert()->success('All messages have been marked as read.');
    return redirect()->back();
}


    public function destroy(Message $message)
    {
        $message->delete();
        sweetalert()->success('Message deleted successfully.');
        return redirect()->route('admin.messages.index');
    }






}