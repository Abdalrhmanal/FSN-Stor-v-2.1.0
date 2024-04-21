<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internationalsim extends Model
{
    use HasFactory;
    protected $table = 'internationalsims';
    // يمكنك أيضًا تحديد الحقول التي يمكن تعبئتها بواسطة النموذج
    protected $fillable = ['first_image', 'second_image', 'serial_number', 'price', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
