<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['service_type', 'service_price'];
    public function simReactivations()
    {
        return $this->hasMany(Simreactivation::class);
    }
    public function internationalActivations()
    {
        return $this->hasMany(Internationalactivation::class);
    }
    public function serviceLogs()
    {
        return $this->hasMany(ServiceLog::class);
    }
}
