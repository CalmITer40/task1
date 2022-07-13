<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public const STATUS_AVAILABLE = 'available';
    public const STATUS_UNAVAILABLE = 'unavailable';
    public const STATUSES = [
        self::STATUS_AVAILABLE => 'Доступен',
        self::STATUS_UNAVAILABLE => 'Не доступен'
    ];

    public $fillable = [
        'article',
        'name',
        'status',
        'data'
    ];

    public $casts = [
        'data' => 'array'
    ];

    public $appends = [
        'status_name'
    ];

    public function scopeAvailable($query)
    {
        return $query->where('status', self::STATUS_AVAILABLE);
    }

    public function getStatusNameAttribute(): string
    {
        return self::STATUSES[$this->status];
    }
}
