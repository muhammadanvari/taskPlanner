<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود</title>
    @vite('resources/css/app.css')
    {{-- اضافه کردن فونت Awesome برای آیکون‌ها --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
{{-- گرادیان پس‌زمینه ملایم‌تر و جذاب‌تر --}}
<body class="bg-gradient-to-br from-gray-50 to-blue-100 font-sans text-gray-800 flex items-center justify-center h-screen">

{{-- کانتینر اصلی با سایه قوی‌تر و گوشه‌های گردتر --}}
<div class="bg-white p-8 md:p-10 rounded-3xl shadow-2xl w-full max-w-md transform hover:shadow-3xl transition-shadow duration-300">

    <div class="text-center mb-8">
        {{-- لوگو یا آیکون برند --}}
        <i class="fas fa-unlock-alt text-4xl text-blue-600 mb-4 animate-bounce-slow"></i>
        <h2 class="text-3xl font-extrabold text-gray-900 mb-2">ورود</h2>
        <p class="text-gray-500 font-medium text-sm">لطفاً ایمیل و رمز عبور خود را وارد کنید.</p>
    </div>

    {{-- نمایش خطاها با طراحی بهتر --}}
    @if($errors->any())
        <div class="bg-red-50 border-r-4 border-red-600 text-red-800 p-4 mb-8 rounded-lg shadow-md transition-all duration-300" role="alert">
            <div class="flex items-center">
                <i class="fas fa-times-circle text-xl ml-3"></i>
                <span class="font-bold">خطای ورود:</span>
            </div>
            <ul class="mt-3 list-disc list-inside text-sm space-y-1 pr-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- بخش فرم (فرم لاگین باید در اینجا اضافه شود) --}}
    @yield('main')

    {{-- Footer یا لینک‌های کمکی --}}
    {{--    <div class="mt-6 text-center text-sm text-gray-500">--}}
    {{--        <a href="#" class="font-medium text-blue-600 hover:text-blue-700 hover:underline transition duration-150">--}}
    {{--            رمز عبور خود را فراموش کرده‌اید؟--}}
    {{--        </a>--}}
    {{--    </div>--}}
</div>
</body>
</html>
