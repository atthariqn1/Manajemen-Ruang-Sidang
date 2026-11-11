<?php

namespace App\Http\Controllers;

use App\Models\RuangSidang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RuangSidangController extends Controller
{
    public function index(): View
    {
        $ruangSidangs = RuangSidang::query()->orderBy('kode_ruang')->get();

        return view('ruang_sidang', [
            'ruangSidangs' => $ruangSidangs,
            'editing' => null,
        ]);
    }

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

    public function edit(RuangSidang $ruangSidang): View
    {
        $ruangSidangs = RuangSidang::query()->orderBy('kode_ruang')->get();

        return view('ruang_sidang', [
            'ruangSidangs' => $ruangSidangs,
            'editing' => $ruangSidang,
        ]);
    }

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

    public function destroy(RuangSidang $ruangSidang): RedirectResponse
    {
        $ruangSidang->delete();

        return redirect('/')->with('success', 'Data ruang sidang berhasil dihapus.');
    }
}
