<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>وعده صادق | ۲۵ سال بعد</title>
    <!-- Tailwind + فونت وزیر -->
    @vite(['resources/js/app.js','resources/css/app.css'])
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    <style>
        * { font-family: 'Vazirmatn', sans-serif; }

        /* افکت حرکت نور روی متن */
        @keyframes shine {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        .text-shine {
            background: linear-gradient(90deg, #cbd5e1 0%, #fef08a 20%, #eab308 40%, #fef08a 60%, #cbd5e1 80%);
            background-size: 200% auto;
            color: transparent;
            -webkit-background-clip: text;
            background-clip: text;
            animation: shine 4s linear infinite;
        }

        /* افکت رادار */
        .radar-effect {
            background: radial-gradient(circle at center, rgba(234,179,8,0.15) 0%, rgba(0,0,0,0) 70%);
        }

        /* استایل شمارش معکوس استراتژیک */
        .strategic-timer {
            box-shadow: 0 0 30px rgba(234, 179, 8, 0.2);
            border: 1px solid rgba(234, 179, 8, 0.3);
            text-shadow: 0 0 10px rgba(234, 179, 8, 0.5);
        }
    </style>
</head>
<body class="bg-[#0b0c0e] text-white antialiased">

<!-- هدر با تصویر پس‌زمینه مفهومی و شمارش معکوس -->
<header class="relative w-full min-h-[85vh] md:min-h-[90vh] flex items-center justify-center overflow-hidden">

    <!-- تصویر پس‌زمینه (قابل تغییر) -->
    <img
        src="{{asset('/uploads/022.jpg')}}"
        alt="افق قدرت و امید"
        class="absolute inset-0 w-full h-full object-cover opacity-40 z-0"
    >

    <!-- اورلی استراتژیک -->
    <div class="absolute inset-0 bg-black/10 z-10"></div>
    <div class="absolute inset-0 radial-gradient z-10"></div>

    <!-- محتوای هدر (پدینگ کمتر) -->
    <div class="relative z-20 text-center px-4 max-w-6xl mx-auto w-full py-8 md:py-12">

        <!-- تگ بیانیه تاریخی -->
        <div class="inline-flex items-center gap-3 bg-black/50 backdrop-blur-sm border border-yellow-600/50 px-4 py-2 rounded-full mb-6 md:mb-8">
            <span class="text-yellow-400 text-xs font-mono tracking-widest" dir="rtl">⏳ ۱۸ شهریور ۱۳۹۴ ⏳</span>
            <span class="w-1 h-1 bg-yellow-500 rounded-full"></span>
            <span class="text-gray-300 text-xs">سخنرانی تاریخی رهبر انقلاب</span>
        </div>

        <!-- نقل قول اصلی (سایز فونت کاهش یافته) -->
        <div class="mb-6 md:mb-8 space-y-2">
            <div class="text-3xl md:text-5xl lg:text-6xl font-black leading-tight">
                <span class="text-white">شما ۲۵ سال آینده را</span>
                <br class="hidden md:block">
                <span class="text-shine"> نخواهید دید</span>
            </div>
            <p class="text-gray-400 text-base md:text-xl max-w-2xl mx-auto font-light tracking-wide px-2">
                به حول و قوه الهی، تا ۲۵ سال آینده چیزی به نام رژیم صهیونیستی وجود نخواهد داشت.
            </p>
            <div class="flex justify-center mt-2">
                <div class="w-16 h-0.5 bg-gradient-to-l from-yellow-500 to-transparent"></div>
                <div class="w-16 h-0.5 bg-gradient-to-r from-yellow-500 to-transparent"></div>
            </div>
        </div>

        <!-- باکس شمارش معکوس (پدینگ و سایز اعداد کاهش یافته) -->
        <div class="bg-[#0b0c0e]/10 strategic-timer rounded-2xl p-4 md:p-6 lg:p-8 inline-block mx-auto shadow-2xl w-full max-w-5xl">

            <div class="flex items-center justify-center gap-2 mb-4 md:mb-6">
                <span class="text-yellow-500 text-xs md:text-sm font-mono tracking-[0.2em] border border-yellow-500/30 px-3 py-1">زمان باقی‌مانده تا تحقق وعده الهی</span>
            </div>

            <!-- تایمر (Gap کمتر، سایز عدد کوچکتر) -->
            <div id="timer" class="flex flex-wrap items-center justify-center gap-1 md:gap-3 lg:gap-4">

                <!-- سال -->
                <div class="flex flex-col items-center w-16 md:w-24 lg:w-28">
                    <div class="bg-black/50 border border-yellow-600/50 rounded-lg md:rounded-xl p-1 md:p-2 w-full">
                        <span id="years" class="text-3xl md:text-5xl lg:text-6xl font-mono font-bold text-yellow-400 block text-center">00</span>
                    </div>
                    <span class="text-[10px] md:text-xs mt-1.5 text-yellow-600 font-medium tracking-wider">سال</span>
                </div>

                <span class="text-xl md:text-3xl text-yellow-700 self-start mt-1 md:mt-2">:</span>

                <!-- ماه -->
                <div class="flex flex-col items-center w-16 md:w-24 lg:w-28">
                    <div class="bg-black/50 border border-yellow-600/50 rounded-lg md:rounded-xl p-1 md:p-2 w-full">
                        <span id="months" class="text-3xl md:text-5xl lg:text-6xl font-mono font-bold text-yellow-400 block text-center">00</span>
                    </div>
                    <span class="text-[10px] md:text-xs mt-1.5 text-yellow-600 font-medium tracking-wider">ماه</span>
                </div>

                <span class="text-xl md:text-3xl text-yellow-700 self-start mt-1 md:mt-2">:</span>

                <!-- روز -->
                <div class="flex flex-col items-center w-16 md:w-24 lg:w-28">
                    <div class="bg-black/50 border border-yellow-600/50 rounded-lg md:rounded-xl p-1 md:p-2 w-full">
                        <span id="days" class="text-3xl md:text-5xl lg:text-6xl font-mono font-bold text-yellow-400 block text-center">00</span>
                    </div>
                    <span class="text-[10px] md:text-xs mt-1.5 text-yellow-600 font-medium tracking-wider">روز</span>
                </div>

                <span class="text-xl md:text-3xl text-yellow-700 self-start mt-1 md:mt-2">:</span>

                <!-- ساعت -->
                <div class="flex flex-col items-center w-16 md:w-24 lg:w-28">
                    <div class="bg-black/50 border border-yellow-600/50 rounded-lg md:rounded-xl p-1 md:p-2 w-full">
                        <span id="hours" class="text-3xl md:text-5xl lg:text-6xl font-mono font-bold text-yellow-400 block text-center">00</span>
                    </div>
                    <span class="text-[10px] md:text-xs mt-1.5 text-yellow-600 font-medium tracking-wider">ساعت</span>
                </div>

                <span class="text-xl md:text-3xl text-yellow-700 self-start mt-1 md:mt-2">:</span>

                <!-- دقیقه -->
                <div class="flex flex-col items-center w-16 md:w-24 lg:w-28">
                    <div class="bg-black/50 border border-yellow-600/50 rounded-lg md:rounded-xl p-1 md:p-2 w-full">
                        <span id="minutes" class="text-3xl md:text-5xl lg:text-6xl font-mono font-bold text-yellow-400 block text-center">00</span>
                    </div>
                    <span class="text-[10px] md:text-xs mt-1.5 text-yellow-600 font-medium tracking-wider">دقیقه</span>
                </div>

                <span class="text-xl md:text-3xl text-yellow-700 self-start mt-1 md:mt-2">:</span>

                <!-- ثانیه -->
                <div class="flex flex-col items-center w-16 md:w-24 lg:w-28">
                    <div class="bg-black/50 border border-yellow-600/50 rounded-lg md:rounded-xl p-1 md:p-2 w-full">
                        <span id="seconds" class="text-3xl md:text-5xl lg:text-6xl font-mono font-bold text-yellow-400 block text-center">00</span>
                    </div>
                    <span class="text-[10px] md:text-xs mt-1.5 text-yellow-600 font-medium tracking-wider">ثانیه</span>
                </div>
            </div>

            <!-- تاریخ هدف -->
            <div class="mt-6 md:mt-8 text-gray-400 font-mono text-xs md:text-sm border-t border-yellow-600/20 pt-4">
                <span class="text-yellow-500">⌛ تاریخ هدف: ۱۸ شهریور ۱۴۱۹ هجری شمسی (سپتامبر ۲۰۴۰ میلادی)</span>
            </div>
        </div>

        <!-- دکمه اسکرول (با فاصله کمتر از بالا) -->
        <div class="mt-8 md:mt-10">
            <a href="#news-section" class="inline-flex items-center gap-2 text-yellow-500/70 hover:text-yellow-400 transition border border-yellow-600/30 rounded-full p-2 backdrop-blur-sm">
                <span class="text-xs tracking-widest">اخبار و تحلیل‌ها</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </a>
        </div>
    </div>
</header>
<!-- بخش اخبار و تحلیل‌های مرتبط -->
<section id="news-section" class="py-20 px-4 max-w-7xl mx-auto scroll-mt-16">

    <div class="text-center mb-16">
        <span class="text-yellow-600 font-mono text-sm tracking-widest border border-yellow-600/30 px-4 py-1">تحلیل و پیگیری</span>
        <h2 class="text-4xl md:text-5xl font-black mt-6 text-white">در مسیر تحقق وعده</h2>
        <p class="text-gray-400 max-w-2xl mx-auto mt-4">آخرین اخبار، گزارش‌ها و تحلیل‌های راهبردی در مورد افول رژیم صهیونیستی</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <!-- کارت خبر ۱ -->
        <div class="group bg-[#111316] border border-gray-800 hover:border-yellow-600/50 rounded-2xl overflow-hidden transition-all duration-500 shadow-xl">
            <div class="h-48 overflow-hidden relative">
                <img src="https://images.pexels.com/photos/4386360/pexels-photo-4386360.jpeg?auto=compress&cs=tinysrgb&w=600" alt="قدرت موشکی" class="w-full h-full object-cover group-hover:scale-105 transition duration-700 opacity-70 group-hover:opacity-100">
                <div class="absolute top-3 right-3">
                    <span class="bg-yellow-600/90 text-black text-xs font-bold px-3 py-1.5 rounded-full">تحلیل ویژه</span>
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-center text-yellow-500/80 text-xs mb-3 font-mono">
                    <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full ml-1"></span>
                    عملیات وعده صادق
                </div>
                <h3 class="text-xl font-bold mb-3 text-white group-hover:text-yellow-400 transition">فروپاشی امنیتی: از طوفان الاقصی تا وعده صادق ۲</h3>
                <p class="text-gray-400 leading-relaxed text-sm">تحلیلگران غربی اذعان می‌کنند که مفهوم "امنیت مطلق" اسرائیل برای همیشه فرو ریخته و روند فرسایش قدرت این رژیم شتاب گرفته است.</p>
            </div>
        </div>

        <!-- کارت خبر ۲ -->
        <div class="group bg-[#111316] border border-gray-800 hover:border-yellow-600/50 rounded-2xl overflow-hidden transition-all duration-500 shadow-xl">
            <div class="h-48 overflow-hidden relative">
                <img src="https://images.pexels.com/photos/167964/pexels-photo-167964.jpeg?auto=compress&cs=tinysrgb&w=600" alt="تظاهرات ضد اسرائیلی" class="w-full h-full object-cover group-hover:scale-105 transition duration-700 opacity-70 group-hover:opacity-100">
                <div class="absolute top-3 right-3">
                    <span class="bg-gray-600/90 text-white text-xs font-bold px-3 py-1.5 rounded-full">گزارش میدانی</span>
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-center text-yellow-500/80 text-xs mb-3 font-mono">
                    <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full ml-1"></span>
                    افول داخلی
                </div>
                <h3 class="text-xl font-bold mb-3 text-white group-hover:text-yellow-400 transition">شکاف اجتماعی بی‌سابقه و مهاجرت معکوس</h3>
                <p class="text-gray-400 leading-relaxed text-sm">رسانه‌های اسرائیلی از خروج سرمایه‌داران و نخبگان خبر می‌دهند. اختلافات داخلی بر سر اصلاحات قضایی و جنگ غزه، موجودیت رژیم را تهدید می‌کند.</p>
            </div>
        </div>

        <!-- کارت خبر ۳ -->
        <div class="group bg-[#111316] border border-gray-800 hover:border-yellow-600/50 rounded-2xl overflow-hidden transition-all duration-500 shadow-xl">
            <div class="h-48 overflow-hidden relative">
                <img src="https://images.pexels.com/photos/21014/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=600" alt="ساعت میدان فلسطین" class="w-full h-full object-cover group-hover:scale-105 transition duration-700 opacity-70 group-hover:opacity-100">
                <div class="absolute top-3 right-3">
                    <span class="bg-green-600/90 text-white text-xs font-bold px-3 py-1.5 rounded-full">نماد مقاومت</span>
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-center text-yellow-500/80 text-xs mb-3 font-mono">
                    <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full ml-1"></span>
                    تهران
                </div>
                <h3 class="text-xl font-bold mb-3 text-white group-hover:text-yellow-400 transition">ساعت شمارش معکوس میدان فلسطین همچنان می‌تپد</h3>
                <p class="text-gray-400 leading-relaxed text-sm">ساعت دیجیتال نصب شده در قلب تهران که روزشماری تا نابودی اسرائیل را نشان می‌دهد، پس از عملیات طوفان الاقصی با استقبال عمومی نمادین‌تری شده است.</p>
            </div>
        </div>
    </div>

    <!-- نقل قول تاکیدی پایین صفحه -->
    <div class="mt-20 text-center border-t border-gray-800 pt-12">
        <blockquote class="text-2xl md:text-3xl text-gray-300 italic max-w-4xl mx-auto font-light">
            "امروز نشانه‌های افول قدرت آمریکا و رژیم صهیونیستی آشکارتر از همیشه است. جوانان ما طلوع خورشید آزادی قدس را به چشم خواهند دید."
            <footer class="text-yellow-500 text-lg mt-4 not-italic">— برگرفته از بیانات رهبر انقلاب</footer>
        </blockquote>
    </div>
</section>

<!-- فوتر -->
<footer class="border-t border-gray-800 mt-10 py-8 text-center text-gray-500 text-sm">
    <p>بازتاب وعده الهی | طراحی شده با افتخار 🇮🇷</p>
    <p class="text-xs mt-2 opacity-50">جمله تاریخی: "اسرائیل ۲۵ سال آینده را نخواهد دید" — ۱۸ شهریور ۱۳۹۴</p>
</footer>

<script>
    (function() {
        // تاریخ هدف: ۱۸ شهریور ۱۴۱۹ هجری شمسی
        // معادل با ۹ سپتامبر ۲۰۴۰ میلادی
        // ماه‌ها در جاوااسکریپت: ۰ = ژانویه, ۸ = سپتامبر
        const targetDate = new Date(2040, 8, 9, 0, 0, 0).getTime();

        const yearsElement = document.getElementById('years');
        const monthsElement = document.getElementById('months');
        const daysElement = document.getElementById('days');
        const hoursElement = document.getElementById('hours');
        const minutesElement = document.getElementById('minutes');
        const secondsElement = document.getElementById('seconds');

        function updateTimer() {
            const now = new Date().getTime();
            let distance = targetDate - now;

            if (distance < 0) {
                // اگر زمان فرا رسید
                yearsElement.innerText = '00';
                monthsElement.innerText = '00';
                daysElement.innerText = '00';
                hoursElement.innerText = '00';
                minutesElement.innerText = '00';
                secondsElement.innerText = '00';

                // تغییر متن هدر به "وعده محقق شد"
                const headerText = document.querySelector('.text-5xl');
                if(headerText) {
                    headerText.innerHTML = '<span class="text-shine">وعده الهی محقق شد</span>';
                }
                return;
            }

            // محاسبات دقیق
            const totalDays = Math.floor(distance / (1000 * 60 * 60 * 24));

            // محاسبه سال (تقریبی با میانگین 365.25 روز)
            const years = Math.floor(totalDays / 365.25);
            const remainingDaysAfterYears = totalDays - Math.floor(years * 365.25);

            // محاسبه ماه (تقریبی با میانگین 30.44 روز)
            const months = Math.floor(remainingDaysAfterYears / 30.44);
            const days = Math.floor(remainingDaysAfterYears - (months * 30.44));

            // محاسبه ساعت، دقیقه و ثانیه
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // به‌روزرسانی DOM
            yearsElement.innerText = years.toString().padStart(2, '0');
            monthsElement.innerText = months.toString().padStart(2, '0');
            daysElement.innerText = days.toString().padStart(2, '0');
            hoursElement.innerText = hours.toString().padStart(2, '0');
            minutesElement.innerText = minutes.toString().padStart(2, '0');
            secondsElement.innerText = seconds.toString().padStart(2, '0');
        }

        updateTimer();
        setInterval(updateTimer, 1000);
    })();
</script>
</body>
</html>
