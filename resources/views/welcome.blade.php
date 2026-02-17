<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسک‌پلنر | نسل جدید مدیریت کارها</title>
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.0.0/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    @vite(['resources/js/app.js','resources/css/app.css'])
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Vazirmatn', 'sans-serif'] },
                    colors: {
                        dark: {
                            900: '#050505',
                            800: '#121212',
                            700: '#1f1f1f',
                        },
                        accent: {
                            500: '#6366f1', // Indigo
                            400: '#818cf8',
                            glow: '#4f46e580'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* پس‌زمینه مش با گرادیانت محو */
        .bg-mesh {
            background-color: #050505;
            background-image: radial-gradient(at 50% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
            radial-gradient(at 100% 0%, rgba(168, 85, 247, 0.15) 0px, transparent 50%);
        }
        /* انیمیشن درخشش ملایم */
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.2); }
            50% { box-shadow: 0 0 40px rgba(99, 102, 241, 0.5); }
        }
        .animate-glow { animation: pulse-glow 3s infinite; }
    </style>
</head>
<body class="font-sans text-slate-300 bg-mesh antialiased min-h-screen selection:bg-accent-500/30 selection:text-white overflow-x-hidden">

<div class="fixed top-6 left-1/2 -translate-x-1/2 w-[90%] max-w-4xl z-50">
    <nav class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-full px-6 py-3 flex justify-between items-center shadow-2xl">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-black text-sm">T</div>
            <span class="text-white font-bold tracking-wide">تسک‌پلنر</span>
        </div>
        <div class="hidden md:flex gap-8 text-sm font-medium text-slate-400">
            <a href="#" class="hover:text-white transition-colors">امکانات</a>
            <a href="#" class="hover:text-white transition-colors">یکپارچگی‌ها</a>
            <a href="#" class="hover:text-white transition-colors">تعرفه‌ها</a>
        </div>
        <div>
            <a href="#" class="bg-white text-dark-900 text-sm font-bold px-5 py-2 rounded-full hover:bg-slate-200 transition-colors">
                شروع رایگان
            </a>
        </div>
    </nav>
</div>

<section class="pt-40 pb-20 px-6 flex flex-col items-center text-center relative z-10">
    <div class="mb-8 inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-sm text-slate-300 backdrop-blur-sm">
            <span class="flex h-2 w-2 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
            </span>
        هوش مصنوعی به تسک‌پلنر اضافه شد
    </div>

    <h1 class="text-5xl md:text-7xl font-black text-white tracking-tight mb-8 leading-[1.1] max-w-4xl">
        تمرکز عمیق، <br>
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400">
                خروجی بی‌نهایت.
            </span>
    </h1>

    <p class="text-lg md:text-xl text-slate-400 max-w-2xl mb-12 font-medium leading-relaxed">
        ابزاری طراحی شده برای تیم‌های پیشرو. پروژه‌ها را مدیریت کنید، زمان را پیگیری کنید و با سرعتی که تا به حال تجربه نکرده‌اید، کارها را به اتمام برسانید.
    </p>

    <div class="flex flex-col sm:flex-row gap-4">
        <button class="px-8 py-4 rounded-full bg-indigo-600 text-white font-bold text-lg hover:bg-indigo-500 transition-all animate-glow">
            همین حالا شروع کنید
        </button>
        <button class="px-8 py-4 rounded-full bg-white/5 border border-white/10 text-white font-bold text-lg hover:bg-white/10 transition-all flex items-center justify-center gap-2">
            ▶ مشاهده دمو
        </button>
    </div>
</section>

<section class="px-6 pb-32 relative z-10 flex justify-center">
    <div class="w-full max-w-5xl rounded-3xl bg-dark-800/50 backdrop-blur-2xl border border-white/10 shadow-[0_0_80px_rgba(99,102,241,0.15)] overflow-hidden">
        <div class="h-12 border-b border-white/10 bg-white/5 flex items-center px-4 gap-2">
            <div class="w-3 h-3 rounded-full bg-slate-700"></div>
            <div class="w-3 h-3 rounded-full bg-slate-700"></div>
            <div class="w-3 h-3 rounded-full bg-slate-700"></div>
        </div>

        <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="hidden md:flex flex-col gap-4 border-l border-white/10 pl-6">
                <div class="h-8 w-24 bg-white/10 rounded-md"></div>
                <div class="h-6 w-full bg-white/5 rounded-md mt-4"></div>
                <div class="h-6 w-3/4 bg-white/5 rounded-md"></div>
                <div class="h-6 w-5/6 bg-white/5 rounded-md"></div>
            </div>

            <div class="col-span-2 flex flex-col gap-4">
                <div class="text-xl font-bold text-white mb-2">کارهای امروز</div>

                <div class="group p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-indigo-500/50 transition-all flex items-center justify-between cursor-pointer">
                    <div class="flex items-center gap-4">
                        <div class="w-6 h-6 rounded-full border-2 border-indigo-500/50 flex items-center justify-center group-hover:bg-indigo-500/20 transition-colors"></div>
                        <span class="text-white font-medium">بازنویسی کدهای لندینگ پیج</span>
                    </div>
                    <span class="text-xs px-2 py-1 rounded-md bg-indigo-500/20 text-indigo-300">طراحی</span>
                </div>

                <div class="p-4 rounded-2xl bg-indigo-500/10 border border-indigo-500/30 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-6 h-6 rounded-full bg-indigo-500 flex items-center justify-center">
                            <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                        </div>
                        <span class="text-white font-medium">جلسه با تیم مارکتینگ</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-indigo-300 font-mono">24:59</span>
                        <span class="text-xl">🍅</span>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-white/5 border border-white/5 flex items-center justify-between opacity-50">
                    <div class="flex items-center gap-4">
                        <div class="w-6 h-6 rounded-full bg-slate-600 flex items-center justify-center text-xs text-white">✓</div>
                        <span class="text-slate-400 font-medium line-through">ارسال ایمیل آپدیت</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="max-w-6xl mx-auto px-6 pb-32">
    <h2 class="text-3xl md:text-5xl font-black text-white text-center mb-16">طراحی شده برای کمال‌گرایان</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="md:col-span-2 bg-dark-800 rounded-3xl p-8 border border-white/10 hover:border-white/20 transition-colors relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <h3 class="text-2xl font-bold text-white mb-3">تایم‌لاین قدرتمند</h3>
            <p class="text-slate-400 mb-6">پروژه‌های پیچیده را با نمای گانت (Gantt) و تقویم یکپارچه، مثل یک پازل ساده حل کنید.</p>
            <div class="w-full h-32 bg-dark-900 rounded-xl border border-white/5 relative overflow-hidden flex flex-col justify-center gap-3 p-4">
                <div class="h-4 bg-indigo-500/40 rounded-full w-3/4 transform -translate-x-4"></div>
                <div class="h-4 bg-purple-500/40 rounded-full w-1/2 transform translate-x-8"></div>
                <div class="h-4 bg-pink-500/40 rounded-full w-2/3"></div>
            </div>
        </div>

        <div class="bg-dark-800 rounded-3xl p-8 border border-white/10 hover:border-white/20 transition-colors relative overflow-hidden">
            <div class="text-4xl mb-4">⏱️</div>
            <h3 class="text-xl font-bold text-white mb-2">تایمر درونی</h3>
            <p class="text-slate-400 text-sm">تکنیک پومودورو مستقیماً روی هر تسک متصل شده است.</p>
        </div>

        <div class="bg-dark-800 rounded-3xl p-8 border border-white/10 hover:border-white/20 transition-colors relative overflow-hidden">
            <div class="text-4xl mb-4">🧠</div>
            <h3 class="text-xl font-bold text-white mb-2">دستیار هوشمند</h3>
            <p class="text-slate-400 text-sm">هوش مصنوعی، کارهای بزرگ را با یک کلیک به زیرتسک تبدیل می‌کند.</p>
        </div>

        <div class="md:col-span-2 bg-dark-800 rounded-3xl p-8 border border-white/10 hover:border-white/20 transition-colors relative overflow-hidden group">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="flex-1">
                    <h3 class="text-2xl font-bold text-white mb-3">گزارش‌های خیره‌کننده</h3>
                    <p class="text-slate-400">نمودارهای زنده از عملکرد شما و تیمتان. ببینید زمانتان کجا صرف می‌شود.</p>
                </div>
                <div class="w-40 h-40 rounded-full border-8 border-dark-900 border-t-indigo-500 border-r-indigo-500 transform rotate-45 shadow-[0_0_30px_rgba(99,102,241,0.2)]"></div>
            </div>
        </div>

    </div>
</section>

<footer class="border-t border-white/10 mt-20">
    <div class="max-w-6xl mx-auto px-6 py-12 flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="flex items-center gap-3 text-white font-bold text-xl">
            <div class="w-6 h-6 rounded bg-indigo-500 flex items-center justify-center text-xs">T</div>
            تسک‌پلنر
        </div>
        <p class="text-slate-500 text-sm">© ۲۰۲۶ تمامی حقوق محفوظ است.</p>
    </div>
</footer>

</body>
</html>
