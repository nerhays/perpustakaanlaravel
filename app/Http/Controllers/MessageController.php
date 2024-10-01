<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\MessageTo;
use App\Models\MessageKategori;
use App\Models\User;
use App\Models\MessageDokumen;

class MessageController extends Controller
{
    public function inbox()
{
    $userId = auth()->user()->id_user;
    $messages = MessageTo::with(['message.senderUser'])
        ->where('to', $userId)
        ->get();

    return view('email.inbox', compact('messages'));
}

    public function deleted() {
        $messages = Message::where('message_status', 'deleted')->get();
        return view('email.deleted', compact('messages'));
    }

    public function draft()
{
    $drafts = Message::where('sender', auth()->user()->id_user)
                     ->where('message_status', 'draft')
                     ->get();

    return view('email.draft', compact('drafts'));
}
public function edit($id)
{
    $draft = Message::findOrFail($id);
    return view('email.edit_draft', compact('draft'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'subject' => 'required|string|max:255',
        'message_text' => 'required|string',
        'to' => 'required|email',
    ]);

    $draft = Message::findOrFail($id);
    $draft->subject = $request->subject;
    $draft->message_text = $request->message_text;
    

    $draft->save();

    return redirect()->route('draft')->with('success', 'Draft updated successfully!');
}


public function sendFromDraft(Request $request, $id)
{
    $message = Message::findOrFail($id);

    $message->update([
        'message_status' => 'sent', 
        'no_mk' => 1, 
        'update_by' => auth()->user()->id_user,
    ]);

    return redirect()->route('sent')->with('success', 'Draft sent successfully!');
}


    public function sent()
{
    $userId = auth()->user()->id_user;
    $messages = Message::with(['messageTo.toUser'])
        ->where('sender', $userId)
        ->where('no_mk', 1)
        ->get();

    return view('email.sent', compact('messages'));
}

    public function create() {
        $users = User::all(); 
        $categories = MessageKategori::all();
    
        return view('email.compose', compact('users', 'categories'));
    }

    public function send(Request $request) {
        $request->validate([
            'to' => 'required|array',
            'subject' => 'required|string|max:255',
            'message_text' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx,txt|max:2048',
        ]);

        $status = $request->input('action') == 'send' ? 'sent' : 'draft';
    
        $message = Message::create([
            'sender' => auth()->id(),
            'subject' => $request->subject,
            'message_text' => $request->message_text,
            'message_status' => $status,
            'no_mk' => $status == 'sent' ? 1 : 2,
            'create_by' => auth()->id(),
            'update_by' => auth()->id(),
        ]);
    
        foreach ($request->to as $recipientId) {
            MessageTo::create([
                'message_id' => $message->message_id,
                'to' => $recipientId,
                'create_by' => auth()->id(),
                'update_by' => auth()->id(),
            ]);
        }
    
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('message_files', 'public');
            MessageDokumen::create([
                'file' => $filePath,
                'description' => $request->input('file_description', ''),
                'message_id' => $message->message_id,
                'create_by' => auth()->id(),
                'update_by' => auth()->id(),
            ]);
        }
    
        if ($status == 'sent') {
            return redirect()->route('sent')->with('success', 'Message sent successfully!');
        } else {
            return redirect()->route('draft')->with('success', 'Message saved to draft.');
        }
    }
    

    public function read($id) {
        $message = Message::with('messageTo', 'senderUser', 'documents', 'messageTo.toUser')->findOrFail($id);
    return view('email.read', compact('message'));
    }

    public function reply(Request $request, $id)
{
    $originalMessage = Message::findOrFail($id);
    $status = $request->input('action') == 'send' ? 'sent' : 'draft';
    $replyMessage = Message::create([
        'sender' => auth()->user()->id_user, 
        'subject' => $request->subject,
        'message_text' => $request->message_text,
        'message_status' => $status, 
        'no_mk' => $status == 'sent' ? 1 : 2, 
        'create_by' => auth()->user()->id_user,
        'update_by' => auth()->user()->id_user,
    ]);
    MessageTo::create([
        'message_id' => $replyMessage->message_id,
        'to' => $request->to,
        'create_by' => auth()->user()->id_user,
        'update_by' => auth()->user()->id_user,
    ]);

    if ($status == 'sent') {
        return redirect()->route('sent')->with('success', 'Your Reply sent successfully!');
    } else {
        return redirect()->route('draft')->with('success', 'Your Reply saved to draft.');
    }
}

    
}
