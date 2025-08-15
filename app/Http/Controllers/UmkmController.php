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
        return view('pages.umkm.index');
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
            'string',
            'max:20',
            'regex:/^[0-9]+$/',
            function ($attribute, $value, $fail) {
                if (!preg_match('/^0/', $value)) {
                    $fail('Nomor telepon harus dimulai dengan angka 0.');
                }
            }
        ],
        'address' => 'required|string',
        'description' => 'required|string',
        'gmaps_embed' => 'required|url|starts_with:https://www.google.com/maps/embed',
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
