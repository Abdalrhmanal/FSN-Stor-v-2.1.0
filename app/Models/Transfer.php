<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'balance_code', 'line_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
