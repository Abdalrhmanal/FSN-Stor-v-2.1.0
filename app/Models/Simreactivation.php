<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simreactivation extends Model
{
    use HasFactory;
    protected $fillable = ['serial_number', 'service_id'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
