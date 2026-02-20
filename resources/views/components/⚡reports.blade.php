<?php

use App\Models\Task;
use App\Models\Category; // اضافه شدن مدل دسته‌بندی
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

        // --- ۵. نمودار تایم‌لاین روزانه (اصلاح شده) ---
        $timelineTasks = Task::where('user_id', $userId)
            ->whereDate('due_date', Carbon::today())
            ->whereNotNull('start_time')
            ->whereNotNull('end_time')
            ->orderBy('start_time')
            ->get()
            ->map(function ($task) {
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

        // محدوده‌های ثابت برای تایم لاین (مثلا از ۶ صبح تا ۱۲ شب)
        $timelineBounds = [
            'start' => Carbon::today()->addHours(6)->timestamp * 1000,
            'end' => Carbon::today()->endOfDay()->timestamp * 1000,
        ];

        // --- ۶. نمودار دسته‌بندی‌ها (NEW) ---
        // فرض بر این است که مدل Category وجود دارد و با Task رابطه دارد
        $categoriesRaw = Category::withCount([
            'tasks as total_tasks' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            },
            'tasks as completed_tasks' => function ($query) use ($userId) {
                $query->where('user_id', $userId)->where('status', 'completed');
            }
        ])->having('total_tasks', '>', 0)->get();

        $categoriesData = [
            'labels' => $categoriesRaw->pluck('name')->toArray(),
            'total' => $categoriesRaw->pluck('total_tasks')->toArray(),
            'completed' => $categoriesRaw->pluck('completed_tasks')->toArray(),
        ];

        // --- آمار کلی ---
        $totalTasks = $completedCount + $pendingCount + $overdueCount;
        $completionRate = $totalTasks > 0 ? round(($completedCount / $totalTasks) * 100) : 0;

        return [
            'labels' => $dates,
            'trend_data' => $completedData,
            'status' => ['completed' => $completedCount, 'pending' => $pendingCount, 'overdue' => $overdueCount],
            'weekly_performance' => $daysOfWeekData,
            'time_distribution' => array_values($timeRanges),
            'timeline' => $timelineTasks,
            'timeline_bounds' => $timelineBounds,
            'categories' => $categoriesData, // داده‌های جدید
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
            this.renderCategoryChart(); // فراخوانی چارت جدید
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

        // چارت جدید دسته‌بندی‌ها
        renderCategoryChart() {
            const ctx = document.getElementById('categoryChart');
            if(!ctx) return;

            // اگر دسته‌بندی وجود نداشت
            if(this.stats.categories.labels.length === 0) return;

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: this.stats.categories.labels,
                    datasets: [
                        {
                            label: 'انجام شده',
                            data: this.stats.categories.completed,
                            backgroundColor: '#10b981', // سبز
                            borderRadius: 4,
                            barPercentage: 0.7,
                        },
                        {
                            label: 'کل تسک‌ها',
                            data: this.stats.categories.total,
                            backgroundColor: '#cbd5e1', // خاکستری روشن
                            borderRadius: 4,
                            barPercentage: 0.7,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top', align: 'end', labels: { boxWidth: 12, usePointStyle: true } }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { borderDash: [4, 4] }, ticks: { stepSize: 1 } },
                        x: { grid: { display: false } }
                    }
                }
            });
        },

        // اصلاح شده: Timeline Chart
        renderTimelineChart() {
            const ctx = document.getElementById('timelineChart');
            if(!ctx) return;

            const tasks = this.stats.timeline;
            if(!tasks || tasks.length === 0) return;

            const dataPoints = tasks.map(t => [t.start, t.end]);
            const labels = tasks.map(t => t.name);
            const backgroundColors = tasks.map(t =>
                t.status === 'completed' ? '#10b981' : '#3b82f6'
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
                        barPercentage: 0.5,
                        borderRadius: 4,
                    }]
                },
                options: {
                    indexAxis: 'y', // افقی کردن
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
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
                            type: 'linear',
                            // اضافه کردن Min و Max ثابت برای نمایش منطقی‌تر روز
                            min: this.stats.timeline_bounds.start,
                            max: this.stats.timeline_bounds.end,
                            ticks: {
                                stepSize: 3600000 * 2, // نمایش هر ۲ ساعت
                                callback: function(value) {
                                    return new Date(value).toLocaleTimeString('fa-IR', {hour: '2-digit', minute:'2-digit'});
                                },
                                maxRotation: 0,
                                autoSkip: true
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

    {{-- Grid Layout (ردیف‌بندی جدید برای ۶ چارت) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- 1. TREND CHART (ردیف اول) --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <h3 class="font-bold text-slate-700 mb-4 flex items-center gap-2">
                <i class="fas fa-chart-line text-indigo-500"></i> روند ۳۰ روز اخیر
            </h3>
            <div class="relative h-72 w-full">
                <canvas id="trendChart"></canvas>
            </div>
        </div>

        {{-- 2. STATUS CHART (ردیف اول) --}}
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

        {{-- 6. CATEGORY CHART (ردیف دوم - چارت جدید) --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <h3 class="font-bold text-slate-700 mb-4 flex items-center gap-2">
                <i class="fas fa-layer-group text-purple-500"></i> عملکرد بر اساس دسته‌بندی
            </h3>
            @if(count($this->stats['categories']['labels']) > 0)
                <div class="relative h-64 w-full">
                    <canvas id="categoryChart"></canvas>
                </div>
            @else
                <div class="h-64 flex flex-col items-center justify-center text-slate-400 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                    <span class="text-sm">هنوز دسته‌بندی ثبت نشده است.</span>
                </div>
            @endif
        </div>

        {{-- 3. BAR CHART (ردیف دوم) --}}
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <h3 class="font-bold text-slate-700 mb-4 flex items-center gap-2">
                <i class="fas fa-calendar-week text-blue-500"></i> عملکرد هفتگی
            </h3>
            <div class="relative h-64 w-full mt-6">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        {{-- 5. TIMELINE CHART (ردیف سوم - فضای بیشتر برای خوانایی) --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
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
                <div class="h-64 flex flex-col items-center justify-center text-slate-400 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                    <i class="far fa-calendar-times text-2xl mb-2"></i>
                    <span class="text-sm">برای امروز هیچ تسک زمان‌داری ثبت نشده است.</span>
                </div>
            @endif
        </div>

        {{-- 4. RADAR CHART (ردیف سوم) --}}
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-slate-700 flex items-center gap-2">
                    <i class="fas fa-crosshairs text-pink-500"></i> رادار تمرکز
                </h3>
            </div>
            <div class="relative h-48 flex-1 w-full">
                <canvas id="radarChart"></canvas>
            </div>
            @php
                $times = $this->stats['time_distribution'];
                $labels = ['صبح', 'ظهر', 'عصر', 'شب'];
                $max = max($times);
                $maxIndex = array_search($max, $times);
            @endphp
            <div class="mt-4 bg-slate-50 p-3 rounded-xl border border-slate-200 text-center">
                <span class="text-xs text-slate-500">اوج فعالیت: </span>
                <span class="text-sm font-bold text-slate-800">{{ $max > 0 ? $labels[$maxIndex] : '-' }}</span>
            </div>
        </div>

    </div>
</main>
