<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ReplyMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    public function index()
    {
        $contactMessages = ContactMessage::latest()->paginate(15);
        return view('admin.contact-messages.index', compact('contactMessages'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        return view('admin.contact-messages.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.contact-messages.index')->with('success', 'Contact message deleted successfully!');
    }

    public function reply(Request $request, $id)
    {
        $message = ContactMessage::findOrFail($id);

        $request->validate([
            'subject'       => ['required', 'string', 'max:255'],
            'reply_message' => ['required', 'string'],
        ]);

        Mail::to($message->email)->send(new ReplyMail(
            replySubject:  $request->input('subject'),
            replyMessage:  $request->input('reply_message'),
            recipientName: $message->first_name . ' ' . $message->last_name,
        ));

        return redirect()->route('admin.contact-messages.show', $id)
            ->with(['message' => 'Reply sent successfully to ' . $message->email, 'alert-type' => 'success']);
    }
}
