<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $umkms = Umkm::where('verified', true)->paginate(6);
        return view('pages.umkm.index', compact('umkms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.umkm.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // Validasi data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|string|max:50',
        'owner' => 'required|string|max:255',
        'phone' => [
            'required',
            'numeric',
            'digits_between:10,15',
            'regex:/^[0-9]+$/',
            function ($attribute, $value, $fail) {
                // Hilangkan semua karakter non-digit
                $cleaned = preg_replace('/[^0-9]/', '', $value);
                
                // Periksa apakah nomor dimulai dengan 62
                if (!preg_match('/^62/', $cleaned)) {
                    $fail('Nomor telepon harus menggunakan kode negara Indonesia (62). Contoh: 628123456789');
                }
                
                // Periksa panjang nomor setelah 62 (minimal 8 digit)
                if (strlen(substr($cleaned, 2)) < 8) {
                    $fail('Nomor telepon setelah kode negara terlalu pendek.');
                }
            }
        ],
        'address' => 'required|string',
        'description' => 'required|string',
        'gmaps_embed' => 'required|url',
        'product_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'agreement' => 'required|accepted'
    ], [
        'gmaps_embed.starts_with' => 'Link Google Maps harus berupa embed URL yang valid',
        'product_photo.max' => 'Ukuran foto produk maksimal 2MB',
        'agreement.accepted' => 'Anda harus menyetujui pernyataan'
    ]);
        
    try {
        // Upload foto produk ke folder 'umkm' dalam storage
        $productPhotoPath = $request->file('product_photo')->store('umkm', 'public');

        // Buat record UMKM
        $umkm = Umkm::create([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'owner' => $validated['owner'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'description' => $validated['description'],
            'gmaps_embed' => $validated['gmaps_embed'],
            'product_photo' => $productPhotoPath, // Simpan path relatif
        ]);

        return redirect()->route('umkm.index')
            ->with('success', 'UMKM berhasil didaftarkan! Menunggu.');

    } catch (\Exception $e) {
        dd($e->getMessage());
        // Hapus file yang sudah terupload jika ada error
        if (isset($productPhotoPath) && Storage::disk('public')->exists($productPhotoPath)) {
            Storage::disk('public')->delete($productPhotoPath);
        }

        return back()->withInput()
            ->with('error', 'Gagal menyimpan UMKM. Error: ' . $e->getMessage());
    }
}   

    /**
     * Display the specified resource.
     */
    public function show(Umkm $umkm)
    {
        return view('pages.umkm.show', compact('umkm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Umkm $umkm)
    {
        $umkm = Umkm::findOrFail($umkm->id);
        return view('pages.umkm.edit', compact('umkm'));
    }

    /** 
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'owner' => 'required|string|max:255',
            'phone' => [
                'required',
                'numeric',
                'digits_between:10,15',
                'regex:/^[0-9]+$/',
                function ($attribute, $value, $fail) {
                    // Hilangkan semua karakter non-digit
                    $cleaned = preg_replace('/[^0-9]/', '', $value);
                    
                    // Periksa apakah nomor dimulai dengan 62
                    if (!preg_match('/^62/', $cleaned)) {
                        $fail('Nomor telepon harus menggunakan kode negara Indonesia (62). Contoh: 628123456789');
                    }
                    
                    // Periksa panjang nomor setelah 62 (minimal 8 digit)
                    if (strlen(substr($cleaned, 2)) < 8) {
                        $fail('Nomor telepon setelah kode negara terlalu pendek.');
                    }
                }
            ],
            'address' => 'required|string',
            'description' => 'required|string',
            'gmaps_embed' => 'required|url',
            'product_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'gmaps_embed.starts_with' => 'Link Google Maps harus berupa embed URL yang valid',
            'product_photo.max' => 'Ukuran foto produk maksimal 2MB',
        ]);
            
        try {
            // Temukan UMKM yang akan diupdate
            $umkm = Umkm::findOrFail($id);
            
            // Simpan path foto lama untuk kemungkinan dihapus nanti
            $oldPhotoPath = $umkm->product_photo;

            // Jika ada file foto baru diupload
            if ($request->hasFile('product_photo')) {
                // Upload foto produk baru ke folder 'umkm' dalam storage
                $productPhotoPath = $request->file('product_photo')->store('umkm', 'public');
                
                // Update path foto produk
                $umkm->product_photo = $productPhotoPath;
            }

            // Update data UMKM
            $umkm->update([
                'name' => $validated['name'],
                'category' => $validated['category'],
                'owner' => $validated['owner'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'description' => $validated['description'],
                'gmaps_embed' => $validated['gmaps_embed'],
                // product_photo sudah diupdate di atas jika ada file baru
            ]);

            // Hapus foto lama jika ada foto baru yang diupload dan foto lama ada
            if ($request->hasFile('product_photo') && $oldPhotoPath) {
                if (Storage::disk('public')->exists($oldPhotoPath)) {
                    Storage::disk('public')->delete($oldPhotoPath);
                }
            }

            return redirect()->route('umkm.index')
                ->with('success', 'Data UMKM berhasil diperbarui!');

        } catch (\Exception $e) {
            // Hapus file yang baru terupload jika ada error
            if (isset($productPhotoPath) && Storage::disk('public')->exists($productPhotoPath)) {
                Storage::disk('public')->delete($productPhotoPath);
            }

            return back()->withInput()
                ->with('error', 'Gagal memperbarui UMKM. Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Temukan UMKM yang akan dihapus
            $umkm = Umkm::findOrFail($id);
            
            // Simpan path foto untuk dihapus nanti
            $photoPath = $umkm->product_photo;
            
            // Hapus data UMKM dari database
            $umkm->delete();
            
            // Hapus file foto dari storage jika ada
            if ($photoPath && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            
            return redirect()->route('umkm.index')
                ->with('success', 'UMKM berhasil dihapus!');
                
        } catch (\Exception $e) {
            return redirect()->route('umkm.index')
                ->with('error', 'Gagal menghapus UMKM. Error: ' . $e->getMessage());
        }
    }

    public function verify(Umkm $umkm)
    {
        // Autoriasi - hanya admin yang boleh melakukan verifikasi
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action. Hanya admin yang dapat memverifikasi UMKM.');
        }

        $umkm->update(['verified' => true]);
        
        return redirect()->back()->with('success', 'UMKM berhasil diverifikasi');
    }

    public function preview(Umkm $umkm)
    {
        try {
            // Handle product photo URL
            $productPhotoUrl = null;
            if ($umkm->product_photo) {
                // Cek format path dan konversi ke URL yang benar
                if (strpos($umkm->product_photo, 'storage/') === 0) {
                    // Path sudah dalam format storage/
                    $relativePath = $umkm->product_photo;
                } else {
                    // Konversi dari path database ke format storage
                    $relativePath = 'storage/' . str_replace('public/', '', $umkm->product_photo);
                }
                
                // Gunakan asset helper untuk generate full URL
                $productPhotoUrl = asset($relativePath);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $umkm->id,
                    'name' => $umkm->name,
                    'owner' => $umkm->owner,
                    'category' => $umkm->category,
                    'phone' => $umkm->phone,
                    'address' => $umkm->address,
                    'description' => $umkm->description,
                    'gmaps_embed' => $umkm->gmaps_embed,
                    'product_photo' => $productPhotoUrl,
                    'created_at' => $umkm->created_at->format('d M Y, H:i'),
                    'updated_at' => $umkm->updated_at->format('d M Y, H:i'),
                    'status' => $umkm->verified ? 'Terverifikasi' : 'Menunggu Verifikasi'
                ],
                'message' => 'Data UMKM berhasil diambil'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error fetching UMKM preview: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data UMKM'
            ], 500);
        }
    }
}
