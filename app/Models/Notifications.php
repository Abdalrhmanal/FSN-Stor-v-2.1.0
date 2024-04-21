<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false; // لتجنب زيادة التلقيم الأوتوماتيكي للمفتاح الرئيسي
    protected $keyType = 'string'; // نوع المفتاح الرئيسي

    protected $fillable = [
        'id', 'type', 'notifiable_type', 'notifiable_id', 'data', 'read_at'
    ];

    protected $casts = [
        'data' => 'array', // قم بتحويل الحقل 'data' إلى نوع مصفوفة
    ];

    protected $dates = [
        'created_at', 'updated_at', 'read_at'
    ];
}
