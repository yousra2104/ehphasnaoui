<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Log;

class ContactMessageController extends Controller
{
    // Affiche la liste des messages de contact
    public function index()
    {
        try {
            $messages = ContactMessage::all();
            Log::info('Fetched contact messages', ['count' => $messages->count()]);
            return view('admin.contact-messages', compact('messages'));
        } catch (\Exception $e) {
            Log::error('Error in contactMessages: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Une erreur s\'est produite lors de la récupération des messages.');
        }
    }

    // Marque un message de contact comme traité
    public function markProcessed($id)
    {
        try {
            $message = ContactMessage::findOrFail($id);
            if ($message->status === 'processed') {
                return redirect()->route('admin.contact-messages')->with('message', 'Ce message est déjà traité.');
            }
            $message->status = 'processed';
            $message->save();
            return redirect()->route('admin.contact-messages')->with('message', 'Message marqué comme traité.');
        } catch (\Exception $e) {
            Log::error('Error in markContactMessageProcessed: ' . $e->getMessage());
            return redirect()->route('admin.contact-messages')->with('error', 'Une erreur s\'est produite lors du marquage du message.');
        }
    }
}