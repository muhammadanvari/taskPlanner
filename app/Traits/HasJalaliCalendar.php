<?php

namespace App\Traits;

use Livewire\Attributes\Computed;
use Morilog\Jalali\Jalalian;

trait HasJalaliCalendar
{
    public $calendarYear;
    public $calendarMonth;

    public function initCalendar($date = null)
    {
        try {
            $jDate = $date ? Jalalian::fromFormat('Y/m/d', $date) : Jalalian::now();
        } catch (\Exception $e) {
            $jDate = Jalalian::now();
        }

        $this->calendarYear = $jDate->getYear();
        $this->calendarMonth = $jDate->getMonth();
    }

    public function nextMonth()
    {
        $this->calendarMonth++;
        if ($this->calendarMonth > 12) {
            $this->calendarMonth = 1;
            $this->calendarYear++;
        }
    }

    public function prevMonth()
    {
        $this->calendarMonth--;
        if ($this->calendarMonth < 1) {
            $this->calendarMonth = 12;
            $this->calendarYear--;
        }
    }

    #[Computed]
    public function monthName()
    {
        $months = [
            1 => 'فروردین', 2 => 'اردیبهشت', 3 => 'خرداد',
            4 => 'تیر', 5 => 'مرداد', 6 => 'شهریور',
            7 => 'مهر', 8 => 'آبان', 9 => 'آذر',
            10 => 'دی', 11 => 'بهمن', 12 => 'اسفند'
        ];
        return $months[$this->calendarMonth] ?? '';
    }

    #[Computed]
    public function calendarStructure()
    {
        // اصلاح مهم: اگر سال و ماه ست نشده بود، همین لحظه ست کن
        if (!$this->calendarYear || !$this->calendarMonth) {
            $this->initCalendar();
        }

        $firstDayOfMonth = (new Jalalian($this->calendarYear, $this->calendarMonth, 1));

        return [
            'year' => $this->calendarYear,    // <--- اضافه شد برای رفع ارور Undefined array key
            'month' => $this->calendarMonth,  // <--- اضافه شد
            'start_padding' => $firstDayOfMonth->getDayOfWeek(),
            'total_days' => $firstDayOfMonth->getMonthDays(),
        ];
    }
}
