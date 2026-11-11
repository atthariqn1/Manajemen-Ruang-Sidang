<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Ruang & Fasilitas Sidang - Sistem Informasi TA</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            color: #2d3748;
            padding: 25px 20px;
        }

        .container {
            max-width: 1050px;
            margin: 0 auto;
        }

        header {
            background: linear-gradient(135deg, #1a365d 0%, #2c3e50 100%);
            color: #ffffff;
            padding: 26px;
            border-radius: 10px;
            margin-bottom: 24px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        header h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        header p {
            font-size: 14px;
            color: #cbd5e0;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: #ffffff;
            padding: 16px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
            border-left: 4px solid #3182ce;
        }

        .stat-card.stat-green { border-left-color: #38a169; }
        .stat-card.stat-purple { border-left-color: #805ad5; }
        .stat-card.stat-orange { border-left-color: #dd6b20; }

        .stat-title {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 600;
            color: #718096;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 22px;
            font-weight: 700;
            color: #2d3748;
            margin-top: 4px;
        }

        /* Alert notifications */
        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 22px;
            font-size: 14px;
            line-height: 1.5;
        }

        .alert-success {
            background-color: #f0fff4;
            color: #22543d;
            border: 1px solid #9ae6b4;
        }

        .alert-danger {
            background-color: #fff5f5;
            color: #742a2a;
            border: 1px solid #feb2b2;
        }

        .alert ul {
            margin-left: 20px;
            margin-top: 6px;
        }

        /* Card Section */
        .card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            padding: 24px;
            margin-bottom: 25px;
        }

        .card-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #edf2f7;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .card h2 {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
        }

        /* Form elements */
        .form-row {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .form-group {
            flex: 1;
            min-width: 240px;
            margin-bottom: 12px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 13px;
            color: #4a5568;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            font-size: 14px;
            color: #2d3748;
            background-color: #ffffff;
            transition: all 0.2s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.15);
        }

        .checkbox-group {
            display: flex;
            gap: 20px;
            padding-top: 8px;
            flex-wrap: wrap;
        }

        .checkbox-group label {
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            font-size: 14px;
            color: #4a5568;
        }

        .checkbox-group input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background-color: #3182ce;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .btn:hover {
            background-color: #2b6cb0;
        }

        .btn-success {
            background-color: #38a169;
        }
        .btn-success:hover {
            background-color: #2f855a;
        }

        .btn-secondary {
            background-color: #718096;
        }
        .btn-secondary:hover {
            background-color: #4a5568;
        }

        .btn-danger {
            background-color: #e53e3e;
        }
        .btn-danger:hover {
            background-color: #c53030;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 4px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        /* Table */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        table th,
        table td {
            padding: 12px 14px;
            text-align: left;
            border-bottom: 1px solid #edf2f7;
            font-size: 14px;
            vertical-align: middle;
        }

        table th {
            background-color: #f7fafc;
            color: #4a5568;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        table tr:hover td {
            background-color: #f8fafc;
        }

        /* Badges */
        .badge-list {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 11px;
            font-weight: 600;
            border-radius: 4px;
        }

        .badge-proyektor {
            background-color: #ebf8ff;
            color: #2b6cb0;
            border: 1px solid #bee3f8;
        }

        .badge-pc {
            background-color: #f0fff4;
            color: #276749;
            border: 1px solid #c6f6d5;
        }

        .badge-ac {
            background-color: #faf5ff;
            color: #6b46c1;
            border: 1px solid #e9d8fd;
        }

        .badge-muted {
            background-color: #edf2f7;
            color: #718096;
        }

        .text-empty {
            text-align: center;
            padding: 36px 16px !important;
            color: #a0aec0;
            font-style: italic;
        }

        .action-cell {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .user-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
            font-size: 13px;
            border: 1px solid #e2e8f0;
        }

        .user-info {
            color: #4a5568;
        }

        .user-info strong {
            color: #2b6cb0;
        }
    </style>
</head>

<body>

    <div class="container">
        @auth
            <div class="user-bar">
                <div class="user-info">
                    👤 Masuk sebagai: <strong>{{ Auth::user()->name }}</strong> 
                    <span style="display: inline-block; padding: 2px 8px; border-radius: 12px; font-size: 11px; font-weight: bold; text-transform: uppercase; margin-left: 6px; {{ Auth::user()->isAdmin() ? 'background: #fed7d7; color: #9b2c2c;' : 'background: #c6f6d5; color: #22543d;' }}">
                        {{ Auth::user()->role }}
                    </span>
                    <span style="color: #718096; font-size: 13px; margin-left: 4px;">({{ Auth::user()->email }})</span>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin keluar dari sistem?');">
                        🚪 Keluar (Logout)
                    </button>
                </form>
            </div>
        @endauth

        <header>
            <h1>Sistem Informasi Tugas Akhir & Skripsi</h1>
            <p>Modul: Manajemen Ruang & Fasilitas Sidang Ujian</p>
        </header>

        {{-- Notifikasi Sukses / Error --}}
        @if (session('success'))
            <div class="alert alert-success" role="status">
                <strong>✓ Berhasil!</strong> {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <strong>Terjadi kesalahan input:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Statistik Ringkasan Ruangan --}}
        @php
            $totalRuang = $ruangSidangs->count();
            $totalKapasitas = $ruangSidangs->sum('kapasitas');
            $proyektorCount = $ruangSidangs->filter(fn($r) => in_array('Proyektor', $r->fasilitas ?? []))->count();
            $pcCount = $ruangSidangs->filter(fn($r) => in_array('PC Sidang', $r->fasilitas ?? []))->count();
            $acCount = $ruangSidangs->filter(fn($r) => in_array('AC', $r->fasilitas ?? []))->count();
        @endphp

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">Total Ruang Sidang</div>
                <div class="stat-value">{{ $totalRuang }}</div>
            </div>
            <div class="stat-card stat-green">
                <div class="stat-title">Total Kapasitas Peserta</div>
                <div class="stat-value">{{ $totalKapasitas }} <span style="font-size: 14px; font-weight: normal; color: #718096;">Orang</span></div>
            </div>
            <div class="stat-card stat-orange">
                <div class="stat-title">Fasilitas Proyektor</div>
                <div class="stat-value">{{ $proyektorCount }} <span style="font-size: 14px; font-weight: normal; color: #718096;">Ruangan</span></div>
            </div>
            <div class="stat-card stat-purple">
                <div class="stat-title">Fasilitas PC Sidang</div>
                <div class="stat-value">{{ $pcCount }} <span style="font-size: 14px; font-weight: normal; color: #718096;">Ruangan</span></div>
            </div>
        </div>

        {{-- Form Tambah / Edit Ruang Sidang --}}
        <section class="card" id="form-section">
            <div class="card-header-flex">
                <h2>
                    @if ($editing)
                        Edit Data Ruang Sidang: <span style="color: #3182ce;">{{ $editing->kode_ruang }}</span>
                    @else
                        Tambah Ruang Sidang Baru
                    @endif
                </h2>
                @if ($editing)
                    <a href="{{ route('ruang-sidang.index') }}" class="btn btn-secondary btn-sm">Batal Edit</a>
                @endif
            </div>

            <form action="{{ $editing ? route('ruang-sidang.update', $editing) : route('ruang-sidang.store') }}" method="POST">
                @csrf
                @if ($editing)
                    @method('PUT')
                @endif

                @php
                    $selectedFasilitas = old('fasilitas', $editing ? $editing->fasilitas : []);
                @endphp

                <div class="form-row">
                    <div class="form-group">
                        <label for="kode_ruang">Kode / Nama Ruangan <span style="color: #e53e3e;">*</span></label>
                        <input type="text" id="kode_ruang" name="kode_ruang"
                            value="{{ old('kode_ruang', $editing->kode_ruang ?? '') }}"
                            placeholder="Contoh: R. Sidang 301 / R. Seminar A" required>
                    </div>
                    <div class="form-group">
                        <label for="gedung">Nomor / Nama Gedung <span style="color: #e53e3e;">*</span></label>
                        <input type="text" id="gedung" name="gedung"
                            value="{{ old('gedung', $editing->gedung ?? '') }}"
                            placeholder="Contoh: Gedung Rektorat Lt. 3 / GD-02" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="kapasitas">Kapasitas (Orang) <span style="color: #e53e3e;">*</span></label>
                        <input type="number" id="kapasitas" name="kapasitas"
                            value="{{ old('kapasitas', $editing->kapasitas ?? '') }}"
                            min="1" placeholder="Contoh: 15" required>
                    </div>
                    <div class="form-group">
                        <label>Fasilitas Ruang Sidang</label>
                        <div class="checkbox-group">
                            <label>
                                <input type="checkbox" name="fasilitas[]" value="Proyektor"
                                    @checked(in_array('Proyektor', (array) $selectedFasilitas, true))>
                                📽️ Proyektor
                            </label>
                            <label>
                                <input type="checkbox" name="fasilitas[]" value="PC Sidang"
                                    @checked(in_array('PC Sidang', (array) $selectedFasilitas, true))>
                                💻 PC Sidang
                            </label>
                            <label>
                                <input type="checkbox" name="fasilitas[]" value="AC"
                                    @checked(in_array('AC', (array) $selectedFasilitas, true))>
                                ❄️ AC
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan / Kondisi Fasilitas Ruangan</label>
                    <textarea id="keterangan" name="keterangan" rows="2"
                        placeholder="Catatan kondisi teknis ruangan (misal: kabel HDMI siap, proyektor tajam)...">{{ old('keterangan', $editing->keterangan ?? '') }}</textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn {{ $editing ? 'btn-success' : 'btn-primary' }}">
                        {{ $editing ? 'Simpan Perubahan Ruangan' : 'Simpan Data Ruangan' }}
                    </button>
                    @if ($editing)
                        <a href="{{ route('ruang-sidang.index') }}" class="btn btn-secondary">Batal</a>
                    @endif
                </div>
            </form>
        </section>

        {{-- Tabel Daftar Ruang Sidang --}}
        <section class="card">
            <div class="card-header-flex">
                <h2>Daftar Ruang Sidang & Fasilitas ({{ $totalRuang }})</h2>
                @if ($editing)
                    <a href="{{ route('ruang-sidang.index') }}#form-section" class="btn btn-primary btn-sm">+ Tambah Baru</a>
                @endif
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Kode Ruang</th>
                            <th>Lokasi Gedung</th>
                            <th>Kapasitas</th>
                            <th>Fasilitas</th>
                            <th>Keterangan</th>
                            <th style="width: 140px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ruangSidangs as $index => $ruang)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $ruang->kode_ruang }}</strong></td>
                                <td>{{ $ruang->gedung }}</td>
                                <td>{{ $ruang->kapasitas }} Orang</td>
                                <td>
                                    <div class="badge-list">
                                        @if (!empty($ruang->fasilitas))
                                            @foreach ($ruang->fasilitas as $item)
                                                @if ($item === 'Proyektor')
                                                    <span class="badge badge-proyektor">📽️ Proyektor</span>
                                                @elseif ($item === 'PC Sidang')
                                                    <span class="badge badge-pc">💻 PC Sidang</span>
                                                @elseif ($item === 'AC')
                                                    <span class="badge badge-ac">❄️ AC</span>
                                                @else
                                                    <span class="badge badge-muted">{{ $item }}</span>
                                                @endif
                                            @endforeach
                                        @else
                                            <span class="badge badge-muted">Tanpa Fasilitas Tambahan</span>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $ruang->keterangan ?: '-' }}</td>
                                <td>
                                    <div class="action-cell" style="justify-content: center;">
                                        <a href="{{ route('ruang-sidang.edit', $ruang) }}" class="btn btn-secondary btn-sm">Edit</a>
                                        @if (Auth::user()->isAdmin())
                                            <form action="{{ route('ruang-sidang.destroy', $ruang) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruang {{ $ruang->kode_ruang }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-empty">
                                    Belum ada data ruang sidang yang tersimpan.<br>
                                    Silakan isi formulir di atas untuk menambahkan master ruang sidang baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    </div>

</body>

</html>
