<!DOCTYPE html>
<html style="background: #f8f9fa url('{{ asset('storage/images/banner.png') }}') repeat fixed; background-size: auto;" lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi - LingKojan</title>
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
            margin-bottom: 15px;
            transition: border-color 0.3s;
        }
        .btn-form-orange {
            background-color: #f07c1b;
            color: white;
            width: 100%;
            padding: 15px;
            border-radius: 15px;
            font-weight: 700;
            margin-top: 20px;
            display: block;
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
            user-select: none;
            transition: color 0.2s;
        }
        .register-card {
            background: white;
            border-radius: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 700px;
        }
        .form-row {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            text-align: left;
        }
        @media (min-width: 768px) {
            .form-row {
                flex-direction: row;
                align-items: center;
            }
            .form-label {
                width: 30%;
                padding-right: 20px;
                margin-bottom: 0;
            }
            .form-input-wrapper {
                width: 70%;
            }
        }
        .form-label {
            font-weight: 700;
            font-size: 14px;
            color: #444;
            margin-bottom: 8px;
        }
        .form-input-wrapper {
            width: 100%;
        }
        select.custom-select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23999' %3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 20px center;
            background-size: 15px;
            padding-right: 45px !important;
            width: 100%;
            border: none;
            outline: none;
            font-size: 14px;
            color: #333;
            background-color: transparent;
            cursor: pointer;
            padding: 15px 20px;
        }
    </style>
</head>
<body style="margin: 0; min-height: 100vh; background: transparent;">
    @include('components.navbar')

    <div class="flex items-center justify-center p-6 mt-6 pb-20">
        <div class="register-card p-10 md:p-14 text-center">
            <img src="{{ asset('storage/images/iconkojan.png') }}" alt="Logo" class="h-6 mx-auto mb-8">
            <h2 class="text-3xl font-bold text-black mb-12">Registrasi</h2>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <!-- Nama -->
                <div class="form-row">
                    <label class="form-label">Nama</label>
                    <div class="form-input-wrapper">
                        <div class="input-container !mb-0 @error('name') border-red-500 @enderror">
                            <div class="icon-side">
                                <svg class="w-5 h-5 @error('name') text-red-400 @else text-gray-400 @enderror" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input type="text" name="name" placeholder="Mona Talia" value="{{ old('name') }}" required>
                        </div>
                        @error('name')
                            <span class="text-xs text-red-500 font-medium mt-1.5 block text-left">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Username -->
                <div class="form-row">
                    <label class="form-label">Username</label>
                    <div class="form-input-wrapper">
                        <div class="input-container !mb-0 @error('username') border-red-500 @enderror">
                            <div class="icon-side">
                                <svg class="w-5 h-5 @error('username') text-red-400 @else text-gray-400 @enderror" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input type="text" name="username" placeholder="monatalia" value="{{ old('username') }}" required>
                        </div>
                        @error('username')
                            <span class="text-xs text-red-500 font-medium mt-1.5 block text-left">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- NIK -->
                <div class="form-row">
                    <label class="form-label">NIK</label>
                    <div class="form-input-wrapper">
                        <div class="input-container !mb-0 @error('nik') border-red-500 @enderror">
                            <div class="icon-side">
                                <svg class="w-5 h-5 @error('nik') text-red-400 @else text-gray-400 @enderror" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input type="text" name="nik" placeholder="3308921673902367" value="{{ old('nik') }}" required>
                        </div>
                        @error('nik')
                            <span class="text-xs text-red-500 font-medium mt-1.5 block text-left">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- No. Telepon -->
                <div class="form-row">
                    <label class="form-label">No. Telepon</label>
                    <div class="form-input-wrapper">
                        <div class="input-container !mb-0 @error('phone') border-red-500 @enderror">
                            <div class="icon-side">
                                <svg class="w-5 h-5 @error('phone') text-red-400 @else text-gray-400 @enderror" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 005.455 5.455l.774-1.548a1 1 0 011.06-.539l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                            </div>
                            <input type="text" name="phone" placeholder="081365489263" value="{{ old('phone') }}" required>
                        </div>
                        @error('phone')
                            <span class="text-xs text-red-500 font-medium mt-1.5 block text-left">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="form-row">
                    <label class="form-label">Email</label>
                    <div class="form-input-wrapper">
                        <div class="input-container !mb-0 @error('email') border-red-500 @enderror">
                            <div class="icon-side">
                                <svg class="w-5 h-5 @error('email') text-red-400 @else text-gray-400 @enderror" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                            </div>
                            <input type="email" name="email" placeholder="mona@gmail.com" value="{{ old('email') }}" required>
                        </div>
                        @error('email')
                            <span class="text-xs text-red-500 font-medium mt-1.5 block text-left">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- RT -->
                <div class="form-row">
                    <label class="form-label">RT</label>
                    <div class="form-input-wrapper">
                        <div class="input-container !mb-0 @error('rt') border-red-500 @enderror">
                            <div class="icon-side">
                                <svg class="w-5 h-5 @error('rt') text-red-400 @else text-gray-400 @enderror" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                            </div>
                            <select name="rt" class="custom-select" required>
                                <option value="" disabled {{ old('rt') ? '' : 'selected' }}>Pilih RT</option>
                                @foreach(['001', '002', '003', '004', '005', '006', '007', '008', '009', '010', '011', '012', '013', '014', '015', '016'] as $rt_option)
                                    <option value="{{ $rt_option }}" {{ old('rt') == $rt_option ? 'selected' : '' }}>{{ $rt_option }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('rt')
                            <span class="text-xs text-red-500 font-medium mt-1.5 block text-left">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <input type="hidden" name="rw" value="006">

                <!-- Password -->
                <div class="form-row">
                    <label class="form-label">Password</label>
                    <div class="form-input-wrapper">
                        <div class="input-container !mb-0 @error('password') border-red-500 @enderror">
                            <div class="icon-side">
                                <svg class="w-5 h-5 @error('password') text-red-400 @else text-gray-400 @enderror" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input type="password" name="password" id="password" placeholder="********" required>
                            <div class="password-toggle pr-5 cursor-pointer text-gray-400" id="togglePassword">
                                <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('password')
                            <span class="text-xs text-red-500 font-medium mt-1.5 block text-left">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="form-row">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="form-input-wrapper">
                        <div class="input-container !mb-0">
                            <div class="icon-side">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="********" required>
                            <div class="password-toggle pr-5 cursor-pointer text-gray-400" id="togglePasswordConfirmation">
                                <svg id="eyeIconConfirmation" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <button type="submit" class="btn-form-orange !w-full !mt-0">Registrasi</button>
                </div>
                
                <div class="mt-12 text-[13px] text-gray-400">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-orange-main font-bold">Login</a>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // NIK: digits only, max 16
        var nikInput = document.querySelector('input[name="nik"]');
        if (nikInput) {
            nikInput.setAttribute('maxlength', '16');
            nikInput.setAttribute('inputmode', 'numeric');
            nikInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16);
            });
            nikInput.addEventListener('paste', function(e) {
                e.preventDefault();
                var p = (e.clipboardData || window.clipboardData).getData('text');
                this.value = (this.value + p).replace(/[^0-9]/g, '').slice(0, 16);
            });
        }

        // Phone: digits only, max 15
        var phoneInput = document.querySelector('input[name="phone"]');
        if (phoneInput) {
            phoneInput.setAttribute('maxlength', '15');
            phoneInput.setAttribute('inputmode', 'numeric');
            phoneInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);
            });
            phoneInput.addEventListener('paste', function(e) {
                e.preventDefault();
                var p = (e.clipboardData || window.clipboardData).getData('text');
                this.value = (this.value + p).replace(/[^0-9]/g, '').slice(0, 15);
            });
        }

        // Username: alphanumeric only, no spaces or symbols, max 50
        var usernameInput = document.querySelector('input[name="username"]');
        if (usernameInput) {
            usernameInput.setAttribute('maxlength', '50');
            usernameInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^a-zA-Z0-9]/g, '').slice(0, 50);
            });
            usernameInput.addEventListener('paste', function(e) {
                e.preventDefault();
                var p = (e.clipboardData || window.clipboardData).getData('text');
                this.value = (this.value + p).replace(/[^a-zA-Z0-9]/g, '').slice(0, 50);
            });
        }

        // Password visibility toggles
        const setupToggle = (toggleId, inputId, iconId) => {
            const toggle = document.getElementById(toggleId);
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (toggle && input && icon) {
                toggle.addEventListener('click', function() {
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    
                    if (type === 'text') {
                        this.classList.add('text-orange-main');
                        this.classList.remove('text-gray-400');
                        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path>`;
                    } else {
                        this.classList.remove('text-orange-main');
                        this.classList.add('text-gray-400');
                        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>`;
                    }
                });
            }
        };

        setupToggle('togglePassword', 'password', 'eyeIcon');
        setupToggle('togglePasswordConfirmation', 'password_confirmation', 'eyeIconConfirmation');
    });
    </script>
</body>
</html>
