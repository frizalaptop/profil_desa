<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'service_type' => 'required|in:surat,bansos,posyandu',
            'file' => 'required|file|mimes:pdf|max:5120'
        ], [
            'file.mimes' => 'File harus berupa PDF',
            'file.max' => 'Ukuran file maksimal 5MB'
        ]);

        try {
            if (auth()->user()->role !== 'admin') {
                throw new \Exception('Akses dilarang. Hanya admin.');
            }
            
            $serviceType = $request->service_type;
            $fileName = $serviceType . '.pdf';
            
            // Simpan file ke storage
            $request->file('file')->storeAs('services', $fileName, 'public');
            
            return back()->with('success', 'File ' . $this->getServiceName($serviceType) . ' berhasil diupload!');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal upload file: ' . $e->getMessage());
        }
    }
    
    private function getServiceName($type)
    {
        $services = [
            'surat' => 'Persyaratan Surat Menyurat',
            'posyandu' => 'Informasi Posyandu & Kesehatan'
        ];
        
        return $services[$type] ?? 'Layanan';
    }
}
