<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Quicksand:wght@600&display=swap"
        rel="stylesheet">
    {{-- alert --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
    integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
        integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- js --}}
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <title>Login - DeepTalk</title>
    @vite('resources/css/app.css')
</head>
<body class="font-nunito">
    <div class="flex items-center lg:justify-between sm:justify-center lg:p-9 sm:p-5 h-screen">
        {{-- left --}}
        <div class="sm:w-1/2 w-4/5 flex flex-col mx-auto items-center">
            <div class="h-fit">
                <div class="mx-auto lg:w-[76%] sm:w-11/12">
                    <p class="text-3xl font-bold text-center">Welcome back!</p>
                    <p class="text-sm font-semibold text-center text-non-active mt-4">Selamat datang kembali ke DeepTalk. konsul! Buat pertemuan lalu Ceritakan masalah-masalahmu dan kami akan membantu mendengar dan mencari solusi.</p>
                </div>
                <div class="mt-14 lg:w-2/3 sm:w-4/5 mx-auto">
                    <form action="{{ route('auth.post.login') }}" method="post">
                        @csrf
                        <div>
                            <input type="email" autocomplete="off" value="{{ isset($data) ? $data->email : (isset($_COOKIE['email']) ? $_COOKIE['email'] : old('email') ) }}" placeholder="Email, nisn atau nip" name="email" required class="input-form-login @error('email') input-form-error @enderror">
                            @error('email')
                                <small class="font-semibold text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-5">
                            <input type="password" autocomplete="off" value="{{ isset($data) ? $data->password : old('password') }}" name="password" required placeholder="Password" class="input-form-login @error('password') input-form-error @enderror">
                            @error('password')
                                <small class="font-semibold text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-5 flex gap-2 items-center">
                            <input type="checkbox" {{ isset($_COOKIE['email']) ? 'checked' : '' }} name="remember" id="" class="accent-primary w-4 h-4 p-2">
                            <p class="text-non-active">Remember me</p>
                        </div>
                        <div class="mt-5">
                            <button class="text-center border rounded-full bg-primary text-white font-semibold px-4 py-3 w-full">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- right --}}
        <div class="bg-secondary rounded-2xl p-4 h-full w-1/2 flex-col items-center justify-center lg:flex hidden">
            <img src="{{ asset('img/logo_login.png') }}" alt="" class="w-64 h-64">
            <div class="mt-7 w-2/3">
                <p class="text-center font-semibold text-[27px]">Improving your life with <span class="text-primary">DeepTalks</span></p>
            </div>
        </div>
    </div>

    @if (Session::has('msg_error'))
        <script>
            Component.showAlert("{{ Session::get('msg_error') }}", 'error')
        </script>
    @elseif(Session::has('msg_success'))
        <script>
            Component.showAlert("{{ Session::get('msg_success') }}", 'success')
        </script>
    @elseif(Session::has('msg_info'))
        <script>
            Component.showAlert("{{ Session::get('msg_info') }}", 'info')
        </script>
    @endif
</body>
</html>