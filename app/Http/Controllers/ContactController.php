<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ContactMessage;
use App\Models\Notice;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store a contact form submission from the public site so it appears
     * in the admin workspace (Online store → Contact messages, inbox).
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:60'],
            'service' => ['nullable', 'string', 'max:80'],
            'message' => ['required', 'string', 'max:4000'],
        ]);

        ContactMessage::create($data);

        Activity::record('message.received', 'New message from '.$data['name']);

        if (Setting::enabled('notify_new_messages', true)) {
            Notice::create([
                'title' => 'New contact message',
                'body' => $data['name'].' asked about '.($data['service'] ?? 'your services').'.',
                'kind' => 'message',
            ]);
        }

        return back()->with('contact_sent', 'Thanks — your message is with us. We usually reply within one working day.');
    }
}
