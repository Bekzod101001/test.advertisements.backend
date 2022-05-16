<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertImage extends Model
{
    use HasFactory;
    public $fillable = ['advert_id', 'path'];
}
