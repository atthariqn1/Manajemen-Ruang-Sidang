<?php

namespace App\Http\Controllers;

use App\Models\RuangSidang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class RuangSidangController extends Controller
{
    /**
     * Menampilkan daftar ruang sidang (Read).
     */
    public function index(): View
    {
        $ruangSidangs = RuangSidang::query()->orderBy('kode_ruang')->get();

        return view('ruang_sidang', [
            'ruangSidangs' => $ruangSidangs,
            'editing' => null,
        ]);
    }

    /**
     * Menyimpan data ruang sidang baru (Create).
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kode_ruang' => ['required', 'string', 'max:255'],
            'gedung' => ['required', 'string', 'max:255'],
            'kapasitas' => ['required', 'integer', 'min:1'],
            'fasilitas' => ['sometimes', 'array'],
            'fasilitas.*' => ['string', 'in:Proyektor,PC Sidang,AC'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $validated['fasilitas'] = $validated['fasilitas'] ?? [];

        RuangSidang::create($validated);

        return redirect('/')->with('success', 'Data ruang sidang berhasil disimpan.');
    }

    /**
     * Menampilkan form ubah data ruang sidang (Update view).
     */
    public function edit(RuangSidang $ruangSidang): View
    {
        $ruangSidangs = RuangSidang::query()->orderBy('kode_ruang')->get();

        return view('ruang_sidang', [
            'ruangSidangs' => $ruangSidangs,
            'editing' => $ruangSidang,
        ]);
    }

    /**
     * Memperbarui data ruang sidang (Update).
     */
    public function update(Request $request, RuangSidang $ruangSidang): RedirectResponse
    {
        $validated = $request->validate([
            'kode_ruang' => ['required', 'string', 'max:255'],
            'gedung' => ['required', 'string', 'max:255'],
            'kapasitas' => ['required', 'integer', 'min:1'],
            'fasilitas' => ['sometimes', 'array'],
            'fasilitas.*' => ['string', 'in:Proyektor,PC Sidang,AC'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $validated['fasilitas'] = $validated['fasilitas'] ?? [];

        $ruangSidang->update($validated);

        return redirect('/')->with('success', 'Data ruang sidang berhasil diperbarui.');
    }

    /**
     * Menghapus data ruang sidang (Delete - Khusus Admin).
     */
    public function destroy(RuangSidang $ruangSidang): RedirectResponse
    {
        // Pemeriksaan Hak Akses menggunakan Gate Authorization
        Gate::authorize('delete-ruang');

        $ruangSidang->delete();

        return redirect('/')->with('success', 'Data ruang sidang berhasil dihapus.');
    }
}
