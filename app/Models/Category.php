<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['image','type', 'price'];
    public function codes()
    {
        return $this->hasMany(Code::class);
    }
     // دالة الأرشفة
    public function archive()
{
    $this->archived = true;
    $this->save();
}
    public function archivecat()
{
    $this->archived = false;
    $this->save();
}
}
