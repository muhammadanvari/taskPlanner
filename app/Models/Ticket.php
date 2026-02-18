<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['parent_id', 'subject', 'message', 'user_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function parent()
    {
        return $this->belongsTo(Ticket::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Ticket::class, 'parent_id');
    }

    // یک Scope کمکی برای گرفتن فقط تیکت‌های اصلی (بدون پاسخ‌ها)
    public function scopeMainTickets($query)
    {
        return $query->whereNull('parent_id');
    }
}
