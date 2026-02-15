<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسک‌پلنر - مدیریت هوشمند پروژه‌ها</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;300;400;700;900&display=swap');
        body { font-family: 'Vazirmatn', sans-serif; }
        .blob { position: absolute; filter: blur(40px); z-index: -1; opacity: 0.4; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 overflow-x-hidden">

<nav class="container mx-auto px-6 py-6 flex justify-between items-center relative z-10">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/30 text-white">
            <i class="fas fa-check-double"></i>
        </div>
        <span class="text-xl font-black tracking-tight text-slate-900">SmartPlanner</span>
    </div>

    <div class="hidden md:flex gap-8 text-sm font-medium text-slate-600">
        <a href="#features" class="hover:text-indigo-600 transition">ویژگی‌ها</a>
        <a href="#pricing" class="hover:text-indigo-600 transition">قیمت‌ها</a>
        <a href="#" class="hover:text-indigo-600 transition">درباره ما</a>
    </div>

    <div class="flex items-center gap-4">
        <a href="#" class="text-slate-600 hover:text-indigo-600 font-bold text-sm transition hidden sm:block">ورود</a>
        <a href="#" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-indigo-200 transition transform hover:-translate-y-1">
            ثبت‌نام رایگان
        </a>
    </div>
</nav>

<header class="relative pt-16 pb-32 lg:pt-24 lg:pb-40 overflow-hidden">
    <div class="blob bg-indigo-300 w-96 h-96 rounded-full top-0 right-0 -mr-20 -mt-20"></div>
    <div class="blob bg-rose-200 w-80 h-80 rounded-full bottom-0 left-0 -ml-20 mb-20"></div>

    <div class="container mx-auto px-6 text-center relative z-10">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-700 text-xs font-bold mb-8 animate-bounce">
            <span class="w-2 h-2 bg-indigo-500 rounded-full"></span>
            نسخه جدید با تقویم شمسی منتشر شد!
        </div>

        <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-slate-900 leading-tight mb-6">
            مدیریت زمان، <br class="hidden md:block">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-rose-500">به سبک حرفه‌ای‌ها</span>
        </h1>

        <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto mb-10 leading-relaxed">
            با تسک‌پلنر، پروژه‌های خود را روی تقویم شمسی مدیریت کنید، گزارش عملکرد بگیرید و با تمرکز بالا به اهداف خود برسید.
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{route('dashboard')}}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl text-lg font-bold shadow-xl shadow-indigo-500/30 transition transform hover:-translate-y-1 flex items-center justify-center gap-3">
                <i class="fas fa-rocket"></i> شروع کنید
            </a>
            <a href="#demo" class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 px-8 py-4 rounded-2xl text-lg font-bold shadow-sm transition flex items-center justify-center gap-3 group">
                <i class="fas fa-play text-indigo-500 group-hover:scale-110 transition"></i> مشاهده دمو
            </a>
        </div>

        <div class="mt-20 relative mx-auto max-w-5xl">
            <div class="absolute inset-0 bg-indigo-600 blur-3xl opacity-20 -z-10 rounded-full transform scale-90"></div>
            <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 p-2 md:p-4">
                <div class="bg-slate-100 rounded-2xl aspect-[16/9] flex items-center justify-center text-slate-400 overflow-hidden relative">
                    <div class="absolute inset-0 grid grid-cols-4 gap-4 p-8 opacity-50">
                        <div class="col-span-1 bg-white rounded-xl h-full shadow-sm"></div>
                        <div class="col-span-3 space-y-4">
                            <div class="h-8 bg-white rounded-lg w-1/3"></div>
                            <div class="grid grid-cols-7 gap-2 h-64">
                                <div class="bg-white rounded-lg"></div>
                                <div class="bg-white rounded-lg border-2 border-indigo-500"></div>
                                <div class="bg-white rounded-lg"></div>
                            </div>
                        </div>
                    </div>
                    <span class="text-xl font-bold relative z-10 bg-white/80 px-6 py-3 rounded-full backdrop-blur-sm shadow-sm">پیش‌نمایش پنل مدیریت</span>
                </div>
            </div>
        </div>
    </div>
</header>

<section id="features" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-black text-slate-900 mb-4">ابزارهایی برای افزایش بهره‌وری</h2>
            <p class="text-slate-500">هر آنچه برای مدیریت منظم کارهایتان نیاز دارید.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="group p-8 rounded-3xl bg-slate-50 hover:bg-indigo-50 transition border border-slate-100 hover:border-indigo-100">
                <div class="w-14 h-14 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition duration-300">
                    <i class="far fa-calendar-alt"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-3">تقویم کاملاً شمسی</h3>
                <p class="text-slate-500 leading-relaxed">برنامه‌ریزی دقیق بر اساس تقویم جلالی با پشتیبانی از مناسبت‌ها و تعطیلات رسمی.</p>
            </div>

            <div class="group p-8 rounded-3xl bg-slate-50 hover:bg-rose-50 transition border border-slate-100 hover:border-rose-100">
                <div class="w-14 h-14 bg-rose-100 text-rose-500 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition duration-300">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-3">گزارش‌های تحلیلی</h3>
                <p class="text-slate-500 leading-relaxed">مشاهده پیشرفت پروژه‌ها، نمودارهای عملکرد روزانه و تحلیل نقاط قوت و ضعف شما.</p>
            </div>

            <div class="group p-8 rounded-3xl bg-slate-50 hover:bg-amber-50 transition border border-slate-100 hover:border-amber-100">
                <div class="w-14 h-14 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition duration-300">
                    <i class="fab fa-google"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-3">همگام با گوگل</h3>
                <p class="text-slate-500 leading-relaxed">اتصال یکپارچه به Google Calendar. تسک‌های شما همیشه و همه‌جا همراهتان هستند.</p>
            </div>
        </div>
    </div>
</section>

<section id="pricing" class="py-20 bg-slate-50 relative overflow-hidden">
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-black text-slate-900 mb-4">پلن‌های منعطف</h2>
            <p class="text-slate-500">با نسخه رایگان شروع کنید و هر وقت آماده بودید ارتقا دهید.</p>
        </div>

        <div class="flex flex-col md:flex-row justify-center gap-8 max-w-4xl mx-auto">
            <div class="bg-white p-8 rounded-3xl border border-slate-200 w-full md:w-1/2 hover:shadow-xl transition relative">
                <h3 class="text-lg font-bold text-slate-500 mb-2">شروع کننده</h3>
                <div class="text-4xl font-black text-slate-900 mb-6">رایگان</div>
                <ul class="space-y-4 mb-8 text-slate-600">
                    <li class="flex items-center gap-3"><i class="fas fa-check text-green-500"></i> ۵ پروژه فعال</li>
                    <li class="flex items-center gap-3"><i class="fas fa-check text-green-500"></i> تقویم شمسی</li>
                    <li class="flex items-center gap-3 opacity-50"><i class="fas fa-times text-slate-300"></i> گزارش‌های پیشرفته</li>
                    <li class="flex items-center gap-3 opacity-50"><i class="fas fa-times text-slate-300"></i> اتصال به گوگل</li>
                </ul>
                <a href="#" class="block w-full py-3 border-2 border-slate-100 hover:border-indigo-600 hover:text-indigo-600 text-slate-600 font-bold rounded-xl text-center transition">ثبت‌نام رایگان</a>
            </div>

            <div class="bg-indigo-900 p-8 rounded-3xl border border-indigo-800 w-full md:w-1/2 shadow-2xl shadow-indigo-500/20 transform md:-translate-y-4 relative overflow-hidden">
                <div class="absolute top-0 left-0 bg-gradient-to-br from-indigo-500 to-transparent w-32 h-32 opacity-20 rounded-br-full"></div>

                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-lg font-bold text-indigo-200">حرفه‌ای</h3>
                    <span class="bg-indigo-500 text-white text-xs px-2 py-1 rounded-lg font-bold">پیشنهادی</span>
                </div>
                <div class="text-4xl font-black text-white mb-6">۹۹،۰۰۰ <span class="text-lg font-normal text-indigo-300">تومان / ماه</span></div>
                <ul class="space-y-4 mb-8 text-indigo-100">
                    <li class="flex items-center gap-3"><i class="fas fa-check text-indigo-400"></i> پروژه‌های نامحدود</li>
                    <li class="flex items-center gap-3"><i class="fas fa-check text-indigo-400"></i> تقویم شمسی + مناسبت‌ها</li>
                    <li class="flex items-center gap-3"><i class="fas fa-check text-indigo-400"></i> گزارش‌های تحلیلی کامل</li>
                    <li class="flex items-center gap-3"><i class="fas fa-check text-indigo-400"></i> اتصال دوطرفه به گوگل</li>
                </ul>
                <a href="#" class="block w-full py-3 bg-indigo-500 hover:bg-indigo-400 text-white font-bold rounded-xl text-center shadow-lg shadow-indigo-500/50 transition">شروع دوره ۱۴ روزه رایگان</a>
            </div>
        </div>
    </div>
</section>

<footer class="bg-slate-900 text-slate-400 py-12 border-t border-slate-800">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center gap-3 mb-4 md:mb-0">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white text-sm">
                    <i class="fas fa-check-double"></i>
                </div>
                <span class="text-lg font-bold text-white">SmartPlanner</span>
            </div>
            <div class="flex gap-6 text-sm">
                <a href="#" class="hover:text-white transition">قوانین و مقررات</a>
                <a href="#" class="hover:text-white transition">حریم خصوصی</a>
                <a href="#" class="hover:text-white transition">تماس با ما</a>
            </div>
            <div class="flex gap-4 mt-4 md:mt-0">
                <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-indigo-600 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-indigo-600 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-indigo-600 hover:text-white transition"><i class="fab fa-github"></i></a>
            </div>
        </div>
        <div class="text-center text-xs mt-8 opacity-50">
            © ۱۴۰۴ تمامی حقوق محفوظ است. طراحی شده با ❤️ و Laravel.
        </div>
    </div>
</footer>

</body>
</html>
