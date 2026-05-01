<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>
@props(['stats'])

<div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm"
     x-data="trendChart(@js($stats))"
     x-init="init()">
    <h3 class="font-bold text-slate-700 mb-4 flex items-center gap-2">
        <i class="fas fa-chart-line text-indigo-500"></i> روند ۳۰ روز اخیر
    </h3>
    <div class="relative h-72 w-full">
        <canvas id="trendChart" x-ref="canvas"></canvas>
    </div>
</div>
@script
<script>
    function trendChart() {
        return {
            chart: null,
            init() {
                this.renderChart();
            },
            renderChart() {
                const ctx = this.$refs.canvas.getContext('2d');
                const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                gradient.addColorStop(0, 'rgba(99, 102, 241, 0.4)');
                gradient.addColorStop(1, 'rgba(99, 102, 241, 0.0)');

                this.chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @js($data['labels']),
                        datasets: [{
                            label: 'تسک‌های انجام شده',
                            data: @js($data['trend_data']),
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
            }
        }
    }
</script>
@endscript
