<?php

namespace App\Http\Controllers;

use App\Mail\ComplaintMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ComplaintController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|email',
            'subject' => 'required|max:20',
            'message' => 'required'
        ]);

        try {
            // Kirim email - ambil penerima dari config/env
            Mail::to(config('mail.admin_email'))->send(new ComplaintMail($data));
            
            return back()->with('success', 'Pengaduan berhasil dikirim!');
        } catch (\Exception $e) {
            Log::error('Gagal mengirim pengaduan: ' . $e);
            return back()->with('error', 'Maaf, terjadi kesalahan. Silakan coba lagi.');
        }
    }
}