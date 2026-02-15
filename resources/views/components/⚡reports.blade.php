<?php

use App\Models\Task;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

new class extends Component {
    #[Computed]
    public function stats()
    {
        $userId = auth()->id();

        // --- ۱. نمودار خطی (Trend) ---
        $dates = [];
        $completedData = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Jalalian::now()->subDays($i);
            $gregorianDate = $date->toCarbon()->format('Y-m-d');
            $dates[] = $date->format('m/d');
            $completedData[] = Task::where('user_id', $userId)
                ->where('status', 'completed')
                ->whereDate('updated_at', $gregorianDate)
                ->count();
        }

        // --- ۲. نمودار دونات (Status) ---
        $completedCount = Task::where('user_id', $userId)->where('status', 'completed')->count();
        $pendingCount = Task::where('user_id', $userId)->where('status', 'pending')->where('due_date', '>=', now())->count();
        $overdueCount = Task::where('user_id', $userId)->where('status', 'pending')->where('due_date', '<', now())->count();

        // --- ۳. نمودار میله‌ای (Weekly) ---
        $weeklyRaw = Task::where('user_id', $userId)
            ->where('status', 'completed')
            ->select(DB::raw('DAYOFWEEK(updated_at) as day_idx'), DB::raw('count(*) as total'))
            ->groupBy('day_idx')
            ->pluck('total', 'day_idx')
            ->toArray();

        $daysOfWeekData = [
            $weeklyRaw[7] ?? 0, // شنبه
            $weeklyRaw[1] ?? 0, // یکشنبه
            $weeklyRaw[2] ?? 0, // دوشنبه
            $weeklyRaw[3] ?? 0, // سه‌شنبه
            $weeklyRaw[4] ?? 0, // چهارشنبه
            $weeklyRaw[5] ?? 0, // پنجشنبه
            $weeklyRaw[6] ?? 0, // جمعه
        ];

        // --- ۴. نمودار راداری (Hours) ---
        $hoursRaw = Task::where('user_id', $userId)
            ->where('status', 'completed')
            ->select(DB::raw('HOUR(updated_at) as hour'))
            ->get();
        $timeRanges = ['morning' => 0, 'afternoon' => 0, 'evening' => 0, 'night' => 0];
        foreach ($hoursRaw as $task) {
            match (true) {
                $task->hour >= 6 && $task->hour < 12 => $timeRanges['morning']++,
                $task->hour >= 12 && $task->hour < 18 => $timeRanges['afternoon']++,
                $task->hour >= 18 && $task->hour <= 23 => $timeRanges['evening']++,
                default => $timeRanges['night']++,
            };
        }

        // --- ۵. نمودار تایم‌لاین روزانه (Daily Schedule - NEW) ---
        // تسک‌های امروز که ساعت شروع و پایان دارند
        // نکته: فرض بر این است که فرمت تاریخ در دیتابیس میلادی (date/datetime) است
        // اگر تاریخ شمسی ذخیره میکنید باید تبدیل کنید. اینجا فرض بر استاندارد لاراول (میلادی) است.

        $timelineTasks = Task::where('user_id', $userId)
            ->whereDate('due_date', Carbon::today()) // فقط کارهای امروز
            ->whereNotNull('start_time')
            ->whereNotNull('end_time')
            ->orderBy('start_time')
            ->get()
            ->map(function ($task) {
                // ساختن Timestamp دقیق برای Chart.js
                // تاریخ امروز + ساعت ذخیره شده
                $dateStr = Carbon::parse($task->due_date)->format('Y-m-d');

                $start = Carbon::parse($dateStr . ' ' . $task->start_time)->timestamp * 1000;
                $end = Carbon::parse($dateStr . ' ' . $task->end_time)->timestamp * 1000;

                return [
                    'name' => mb_strimwidth($task->title, 0, 25, '...'),
                    'start' => $start,
                    'end' => $end,
                    'status' => $task->status
                ];
            });

        // --- آمار کلی ---
        $totalTasks = $completedCount + $pendingCount + $overdueCount;
        $completionRate = $totalTasks > 0 ? round(($completedCount / $totalTasks) * 100) : 0;

        return [
            'labels' => $dates,
            'trend_data' => $completedData,
            'status' => ['completed' => $completedCount, 'pending' => $pendingCount, 'overdue' => $overdueCount],
            'weekly_performance' => $daysOfWeekData,
            'time_distribution' => array_values($timeRanges),
            'timeline' => $timelineTasks, // داده جدید تایم‌لاین
            'completion_rate' => $completionRate,
            'total_tasks' => $totalTasks
        ];
    }
};
?>

<main class="flex-1 overflow-y-auto p-4 lg:p-8 space-y-8"
      x-data="{
        stats: @js($this->stats),
        init() {
            this.renderTrendChart();
            this.renderStatusChart();
            this.renderBarChart();
            this.renderRadarChart();
            this.renderTimelineChart();
        },

        renderTrendChart() {
            const ctx = document.getElementById('trendChart');
            if(!ctx) return;
            const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(99, 102, 241, 0.4)');
            gradient.addColorStop(1, 'rgba(99, 102, 241, 0.0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: this.stats.labels,
                    datasets: [{
                        label: 'تسک‌های انجام شده',
                        data: this.stats.trend_data,
                        borderColor: '#6366f1',
                        backgroundColor: gradient,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { borderDash: [4, 4] }, ticks: { stepSize: 1 } },
                        x: { grid: { display: false } }
                    }
                }
            });
        },

        renderStatusChart() {
            const ctx = document.getElementById('doughnutChart');
            if(!ctx) return;
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['انجام شده', 'جاری', 'تاخیر'],
                    datasets: [{
                        data: [this.stats.status.completed, this.stats.status.pending, this.stats.status.overdue],
                        backgroundColor: ['#10b981', '#f59e0b', '#f43f5e'],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: { legend: { display: false } }
                }
            });
        },

        renderBarChart() {
            const ctx = document.getElementById('barChart');
            if(!ctx) return;
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['شنبه', '۱شنبه', '۲شنبه', '۳شنبه', '۴شنبه', '۵شنبه', 'جمعه'],
                    datasets: [{
                        label: 'تسک‌های تکمیل شده',
                        data: this.stats.weekly_performance,
                        backgroundColor: '#3b82f6',
                        borderRadius: 4,
                        barThickness: 20
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { display: false }, ticks: { stepSize: 1 } },
                        x: { grid: { display: false } }
                    }
                }
            });
        },

        renderRadarChart() {
            const ctx = document.getElementById('radarChart');
            if(!ctx) return;
            new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: ['صبح (۶-۱۲)', 'ظهر (۱۲-۱۸)', 'عصر (۱۸-۲۴)', 'شب (۰-۶)'],
                    datasets: [{
                        label: 'تمرکز زمانی',
                        data: this.stats.time_distribution,
                        backgroundColor: 'rgba(236, 72, 153, 0.2)',
                        borderColor: '#ec4899',
                        pointBackgroundColor: '#ec4899',
                        pointBorderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        r: {
                            angleLines: { display: true },
                            grid: { color: '#f1f5f9' },
                            pointLabels: { font: { size: 11 }, color: '#64748b' },
                            ticks: { display: false, backdropColor: 'transparent' }
                        }
                    },
                    plugins: { legend: { display: false } }
                }
            });
        },

        // 5. Timeline Chart (Daily Schedule - NEW)
        renderTimelineChart() {
            const ctx = document.getElementById('timelineChart');
            if(!ctx) return;

            const tasks = this.stats.timeline;

            // اگر تسکی برای امروز نیست
            if(!tasks || tasks.length === 0) {
                // میتوانید اینجا منطقی بنویسید که نمودار خالی نشان ندهد
                // اما فعلا Chart.js هندل میکند
            }

            const dataPoints = tasks.map(t => [t.start, t.end]);
            const labels = tasks.map(t => t.name);
            const backgroundColors = tasks.map(t =>
                t.status === 'completed' ? '#10b981' : '#3b82f6' // سبز یا آبی
            );

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'زمان‌بندی',
                        data: dataPoints,
                        backgroundColor: backgroundColors,
                        borderWidth: 0,
                        barPercentage: 0.6,
                        borderRadius: 4,
                    }]
                },
                options: {
                    indexAxis: 'y', // افقی کردن نمودار
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    // تبدیل تایم‌استمپ به ساعت خوانا
                                    const start = new Date(context.raw[0]).toLocaleTimeString('fa-IR', {hour: '2-digit', minute:'2-digit'});
                                    const end = new Date(context.raw[1]).toLocaleTimeString('fa-IR', {hour: '2-digit', minute:'2-digit'});
                                    return `${start} تا ${end}`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            position: 'top',
                            type: 'linear', // چون دیتا تایم‌استمپ است
                            ticks: {
                                callback: function(value) {
                                    // نمایش ساعت روی محور افقی
                                    return new Date(value).toLocaleTimeString('fa-IR', {hour: '2-digit', minute:'2-digit'});
                                },
                                maxRotation: 0,
                                autoSkip: true,
                                maxTicksLimit: 6
                            },
                            grid: { borderDash: [2, 2] }
                        },
                        y: { grid: { display: false } }
                    }
                }
            });
        }
      }"
>
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-100 pb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">داشبورد آنالیز</h1>
            <p class="text-slate-500 text-sm mt-1">بررسی الگوهای رفتاری و پیشرفت پروژه</p>
        </div>
        <div class="bg-white px-4 py-2 rounded-lg border border-slate-200 shadow-sm text-sm flex gap-4">
            <div>کل تسک‌ها: <span class="font-bold text-slate-800">{{ $this->stats['total_tasks'] }}</span></div>
            <div class="border-r border-slate-200 pr-4">نرخ تکمیل: <span class="font-bold text-emerald-600">%{{ $this->stats['completion_rate'] }}</span></div>
        </div>
    </div>

    {{-- Grid Layout --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- 1. TREND CHART --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <h3 class="font-bold text-slate-700 mb-4 flex items-center gap-2">
                <i class="fas fa-chart-line text-indigo-500"></i> روند ۳۰ روز اخیر
            </h3>
            <div class="relative h-72 w-full">
                <canvas id="trendChart"></canvas>
            </div>
        </div>

        {{-- 2. STATUS CHART --}}
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col">
            <h3 class="font-bold text-slate-700 mb-4 flex items-center gap-2">
                <i class="fas fa-chart-pie text-emerald-500"></i> وضعیت کلی
            </h3>
            <div class="relative h-48 flex-1 flex justify-center items-center">
                <canvas id="doughnutChart"></canvas>
                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                    <span class="text-3xl font-bold text-slate-800">{{ $this->stats['total_tasks'] }}</span>
                    <span class="text-[10px] text-slate-400">کل تسک‌ها</span>
                </div>
            </div>
            <div class="mt-4 flex justify-around text-xs text-slate-500">
                <span><span class="inline-block w-2 h-2 rounded-full bg-emerald-500 ml-1"></span>انجام شده</span>
                <span><span class="inline-block w-2 h-2 rounded-full bg-amber-500 ml-1"></span>جاری</span>
                <span><span class="inline-block w-2 h-2 rounded-full bg-rose-500 ml-1"></span>تاخیر</span>
            </div>
        </div>

        {{-- 3. BAR CHART --}}
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <h3 class="font-bold text-slate-700 mb-4 flex items-center gap-2">
                <i class="fas fa-calendar-week text-blue-500"></i> عملکرد هفتگی
            </h3>
            <p class="text-xs text-slate-400 mb-4">فعالیت بر اساس روزهای هفته</p>
            <div class="relative h-64 w-full">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        {{-- 4. RADAR CHART --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-slate-700 flex items-center gap-2">
                    <i class="fas fa-crosshairs text-pink-500"></i> رادار تمرکز زمانی
                </h3>
            </div>
            <div class="flex flex-col sm:flex-row items-center gap-8">
                <div class="relative h-64 w-full sm:w-1/2">
                    <canvas id="radarChart"></canvas>
                </div>
                <div class="w-full sm:w-1/2 space-y-4">
                    @php
                        $times = $this->stats['time_distribution'];
                        $labels = ['صبح', 'ظهر', 'عصر', 'شب'];
                        $max = max($times);
                        $maxIndex = array_search($max, $times);
                    @endphp
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                        <span class="text-xs text-slate-500 block mb-1">اوج فعالیت:</span>
                        <span class="text-lg font-bold text-slate-800">{{ $max > 0 ? $labels[$maxIndex] : '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- 5. TIMELINE CHART (Daily Schedule) --}}
        <div class="lg:col-span-3 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm mt-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-slate-700 flex items-center gap-2">
                    <i class="far fa-clock text-blue-500"></i> برنامه امروز
                </h3>
                <span class="text-xs text-slate-400">
                    {{ \Morilog\Jalali\Jalalian::now()->format('%A، %d %B') }}
                </span>
            </div>

            @if(count($this->stats['timeline']) > 0)
                <div class="relative h-64 w-full">
                    <canvas id="timelineChart"></canvas>
                </div>
            @else
                <div class="h-32 flex flex-col items-center justify-center text-slate-400 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                    <i class="far fa-calendar-times text-2xl mb-2"></i>
                    <span class="text-sm">برای امروز هیچ تسک زمان‌داری ثبت نشده است.</span>
                </div>
            @endif
        </div>

    </div>
</main>
