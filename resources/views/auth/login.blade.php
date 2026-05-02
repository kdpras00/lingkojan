<!DOCTYPE html>
<html style="background: #f8f9fa url('{{ asset('storage/images/banner.png') }}') repeat fixed; background-size: auto;" lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - LingKojan</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="preload" as="image" href="{{ asset('storage/images/banner.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-image: url("{{ asset('storage/images/banner.png') }}");
            background-size: auto;
            background-repeat: repeat;
            background-attachment: fixed;
            color: #333;
        }
        .bg-orange-main { background-color: #f07c1b; }
        .text-orange-main { color: #f07c1b; }

        .nav-link { color: #333; font-weight: 500; transition: color 0.3s; white-space: nowrap; }
        .nav-link:hover { color: #f07c1b; }
        .input-container {
            display: flex;
            align-items: center;
            background: white;
            border: 1.5px solid #eee;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 20px;
            transition: border-color 0.3s;
        }
        .input-container:focus-within {
            border-color: #f07c1b;
        }
        .icon-side {
            width: 60px;
            height: 55px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            border-right: 1.5px solid #eee;
            flex-shrink: 0;
        }
        .input-container input {
            flex-grow: 1;
            padding: 15px 20px;
            border: none;
            outline: none;
            font-size: 14px;
            color: #333;
        }
        .input-container input::placeholder {
            color: #aaa;
            font-weight: 400;
        }
        .password-toggle {
            padding-right: 20px;
            color: #ccc;
            cursor: pointer;
        }
        .login-card {
            background: white;
            border-radius: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 480px;
        }
        .btn-form-orange {
            background-color: #f07c1b;
            color: white;
            width: 100%;
            padding: 15px;
            border-radius: 15px;
            font-weight: 700;
            margin-top: 10px;
            display: block;
        }
        .nav-link { color: #333; font-weight: 500; }
        .text-orange-main { color: #f07c1b; }
    
        }');
            background-repeat: repeat;
            background-size: auto;
            z-index: -1;
            transform: translateZ(0);
            will-change: transform;
        }
    
    
        @keyframes fadeInPage {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .main-content, .card, .navbar-main, .auth-container {
            animation: fadeInPage 0.4s ease-out forwards;
        }
    
    </style>
</head>
<body style="margin: 0; min-height: 100vh; background: transparent;">
    @include('components.navbar')

    <div class="flex items-center justify-center p-6 mt-10">
        <div class="login-card p-12 text-center">
            <img src="{{ asset('storage/images/iconkojan.png') }}" alt="Logo" class="h-8 mx-auto mb-10">
            <h2 class="text-3xl font-bold text-black mb-10">Login</h2>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <!-- Login (Email or Username) -->
                <div class="input-container {{ $errors->has('login') ? 'border-red-500' : '' }}">
                    <div class="icon-side">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="text" name="login" value="{{ old('login') }}" placeholder="Email atau Username" required autofocus>
                </div>
                @error('login')
                    <div class="text-red-500 text-xs mt-[-15px] mb-4 text-left ml-2 font-bold">{{ $message }}</div>
                @enderror

                <!-- Password -->
                <div class="input-container">
                    <div class="icon-side">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="password" name="password" placeholder="••••••••••••" required>
                    <div class="password-toggle">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                </div>

                <button type="submit" class="btn-form-orange">Login</button>
                
                <div class="mt-8 text-[12px] text-gray-400">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-orange-main font-bold">Daftar sekarang</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
