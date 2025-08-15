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
        $umkms = Umkm::paginate(6);
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
        
        // Alternatif dengan nama file unik:
        // $productPhotoPath = $request->file('product_photo')->storeAs(
        //     'umkm',
        //     time() . '_' . $request->file('product_photo')->getClientOriginalName(),
        //     'public'
        // );

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
            ->with('success', 'UMKM berhasil didaftarkan! Menunggu verifikasi admin.');

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Umkm $umkm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Umkm $umkm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Umkm $umkm)
    {
        //
    }
}
