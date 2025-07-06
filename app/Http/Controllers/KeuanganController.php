<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Http\Requests\StoreKeuanganRequest;
use App\Http\Requests\UpdateKeuanganRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $role = session()->get('role');
        $query = Keuangan::with('bendahara');

        // Filter berdasarkan tanggal jika tersedia
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal', [$request->tanggal_mulai, $request->tanggal_akhir]);
        }

         // Filter berdasarkan jenis jika tersedia
    if ($request->filled('jenis')) {
        $query->where('jenis', $request->jenis);
    }

        $keuangan = $query->paginate(10);


        if($role == 'bendahara') {
            return view('bendahara.keuangan', compact('keuangan'));
        }else{
            return view('admin.keuangan', compact('keuangan'));
        }


    }

    public function rekap(Request $request){
        $role = session()->get('role');
        $query = Keuangan::with('bendahara');

        // Filter berdasarkan tanggal jika tersedia
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal', [$request->tanggal_mulai, $request->tanggal_akhir]);
        }

         // Filter berdasarkan jenis jika tersedia
    if ($request->filled('jenis')) {
        $query->where('jenis', $request->jenis);
    }

        $keuangan = $query->paginate(10);


        if($role == 'bendahara') {
            return view('bendahara.rekapkeuangan', compact('keuangan'));
        }else{
            return view('admin.keuangan', compact('keuangan'));
        }

    }

    public function cetakPDF(Request $request)
    {
        $query = Keuangan::query();

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal', [$request->tanggal_mulai, $request->tanggal_akhir]);
        }

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        $keuangan = $query->get();

        $pdf = Pdf::loadView('bendahara.rekapkeuanganpdf', compact('keuangan'))->setPaper('a4', 'portrait');

        return $pdf->download('rekap-keuangan.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $user = session()->get('user');
        $validated = $request->validate([
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'keterangan' => 'nullable|string',
            'bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'jumlah.required' => 'Jumlah tidak boleh kosong.',
            'jumlah.numeric' => 'Jumlah harus berupa angka.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Tanggal tidak valid.',
            'jenis.required' => 'Jenis transaksi harus dipilih.',
            'jenis.in' => 'Jenis transaksi tidak valid.',
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'bukti.required' => 'Bukti wajib diunggah.',
            'bukti.image' => 'File bukti harus berupa gambar.',
            'bukti.mimes' => 'Format bukti harus jpeg, png, atau jpg.',
            'bukti.max' => 'Ukuran bukti tidak boleh lebih dari 2MB.',
        ]);

        // Simpan file ke storage
        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti_keuangan', 'public');
        }

        // Simpan ke database
        Keuangan::create([
            'id_bendahara' => $user->id_bendahara,
            'jumlah' => $validated['jumlah'],
            'tanggal' => $validated['tanggal'],
            'jenis' => $validated['jenis'],
            'keterangan' => $validated['keterangan'] ?? '',
            'bukti_transaksi' => $path ?? null,
        ]);

        return redirect()->route('keuangan.index')->with('success', 'Data keuangan berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Keuangan $keuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keuangan $keuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $keuangan = Keuangan::findOrFail($id);

        $validated = $request->validate([
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'keterangan' => 'nullable|string',
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'jumlah.required' => 'Jumlah tidak boleh kosong.',
            'jumlah.numeric' => 'Jumlah harus berupa angka.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Tanggal tidak valid.',
            'jenis.required' => 'Jenis transaksi harus dipilih.',
            'jenis.in' => 'Jenis transaksi tidak valid.',
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'bukti.image' => 'File bukti harus berupa gambar.',
            'bukti.mimes' => 'Format bukti harus jpeg, png, atau jpg.',
            'bukti.max' => 'Ukuran bukti tidak boleh lebih dari 2MB.',
        ]);

        // Handle bukti baru jika diupload
        if ($request->hasFile('bukti')) {
            // Hapus bukti lama jika ada
            if ($keuangan->bukti_transaksi && Storage::disk('public')->exists($keuangan->bukti_transaksi)) {
                Storage::disk('public')->delete($keuangan->bukti_transaksi);
            }

            // Upload bukti baru
            $path = $request->file('bukti')->store('bukti_keuangan', 'public');
            $keuangan->bukti_transaksi = $path;
        }

        // Update data lainnya
        $keuangan->jumlah = $validated['jumlah'];
        $keuangan->tanggal = $validated['tanggal'];
        $keuangan->jenis = $validated['jenis'];
        $keuangan->keterangan = $validated['keterangan'] ?? '';
        $keuangan->save();

        return redirect()->route('keuangan.index')->with('success', 'Data keuangan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $keuangan = Keuangan::findOrFail($id);

        // Hapus file bukti jika ada
        if ($keuangan->bukti_transaksi && Storage::disk('public')->exists($keuangan->bukti_transaksi)) {
            Storage::disk('public')->delete($keuangan->bukti_transaksi);
        }

        // Hapus data keuangan
        $keuangan->delete();

        return redirect()->route('keuangan.index')->with('success', 'Data keuangan berhasil dihapus!');
    }
}
