<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simcard extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'serial_number', 'price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function soldLines()
    {
        return $this->hasMany(Soldline::class, 'simcard_id');
    }


}
