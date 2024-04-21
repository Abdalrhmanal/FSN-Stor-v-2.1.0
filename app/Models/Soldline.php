<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soldline extends Model
{
    use HasFactory;
    protected $fillable = ['first_image', 'second_image', 'simcard_id'];


    public function simcard()
    {
        return $this->belongsTo(Simcard::class, 'simcard_id');
    }
 

}
