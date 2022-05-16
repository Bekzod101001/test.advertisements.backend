<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory;

    public $fillable = ['title', 'description', 'author_id'];

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function images() {
        return $this->hasMany(AdvertImage::class);
    }

}
