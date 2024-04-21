<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coderecord extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'code_id'];

   // تحديد العلاقة مع نموذج Code
   public function code()
   {
       return $this->belongsTo(Code::class, 'code_id');
   }

   // تحديد العلاقة مع نموذج User
   public function user()
   {
       return $this->belongsTo(User::class, 'user_id');
   }

   // دالة للحصول على جميع الأكواد
   public static function getAllCodes()
   {
       // استخدام Eager Loading لتحميل العلاقات
       return static::with(['code', 'user'])->get();
   }

}
