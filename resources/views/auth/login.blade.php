<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Ruang & Fasilitas Sidang</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f0f4f8;
            color: #2d3748;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 440px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .login-header {
            background: linear-gradient(135deg, #1a365d 0%, #2c3e50 100%);
            color: #ffffff;
            padding: 30px 24px;
            text-align: center;
        }

        .login-header h1 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 6px;
            letter-spacing: -0.3px;
        }

        .login-header p {
            font-size: 13px;
            color: #cbd5e0;
        }

        .login-body {
            padding: 28px 24px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
            line-height: 1.4;
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

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 13px;
            color: #4a5568;
        }

        .form-group input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            font-size: 14px;
            color: #2d3748;
            transition: all 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.15);
        }

        .remember-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #4a5568;
        }

        .remember-group input[type="checkbox"] {
            cursor: pointer;
            width: 15px;
            height: 15px;
        }

        .btn-submit {
            width: 100%;
            background-color: #3182ce;
            color: #ffffff;
            border: none;
            padding: 11px 18px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-submit:hover {
            background-color: #2b6cb0;
        }

        .credential-box {
            margin-top: 24px;
            padding: 14px;
            background-color: #edf2f7;
            border-left: 4px solid #3182ce;
            border-radius: 4px;
            font-size: 12px;
            color: #4a5568;
        }

        .credential-box strong {
            display: block;
            margin-bottom: 4px;
            color: #2c3e50;
        }

        .credential-box code {
            background-color: #e2e8f0;
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 12px;
            font-family: Consolas, monospace;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="login-header">
            <h1>Sistem Informasi TA & Skripsi</h1>
            <p>Login Modul Ruang & Fasilitas Sidang</p>
        </div>

        <div class="login-body">
            {{-- Notifikasi Sukses Logout --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Notifikasi Error Validasi / Kredensial --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', 'admin@sidang.ac.id') }}" required autofocus placeholder="nama@sidang.ac.id">
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi (Password)</label>
                    <input type="password" id="password" name="password" required placeholder="Masukkan kata sandi">
                </div>

                <div class="remember-group">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingat saya di perangkat ini</label>
                </div>

                <button type="submit" class="btn-submit">Masuk ke Sistem (Login)</button>
            </form>

            <div class="credential-box">
                <strong>🔑 Akun Demo untuk Pengujian Video:</strong>
                Email: <code>admin@sidang.ac.id</code><br>
                Password: <code>password123</code>
            </div>
        </div>
    </div>

</body>

</html>

