<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>وبلاگ  {{ setting('site_title') }} </title>
    @vite(['resources/js/app.js','resources/css/app.css'])
    <link href="{{asset('/font/vazir-font-v16.1.0/Vazir.woff')}}" rel="stylesheet">
    <style>
        body { font-family: 'Vazirmatn', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased selection:bg-indigo-200 selection:text-indigo-900 overflow-x-hidden">

<!-- Navigation (Simplified) -->
<nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="  space-x-8  text-slate-600 font-medium">
                <a href="{{url('/')}}" class="hover:text-indigo-600 transition-colors">صفحه اصلی</a>
                <a href="{{url('/blog')}}" class="text-indigo-600 font-bold">وبلاگ</a>
            </div>
            <div class="flex items-center gap-2">
                    <span class="font-extrabold text-xl text-slate-800 tracking-tight">{{ setting('site_title') }}</span>
                <a href="{{url('/')}}">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl">T</div>
                </a>
            </div>
        </div>
    </div>
</nav>

@yield('main')

<!-- Footer (Simplified) -->
<footer class="bg-white border-t border-slate-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-slate-500 text-sm">© ۱۴۰۵ تمامی حقوق برای تسک پلنر محفوظ است.</p>
    </div>
</footer>

</body>
</html>
