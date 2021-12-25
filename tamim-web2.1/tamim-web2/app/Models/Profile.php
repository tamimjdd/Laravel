<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function profileImage(){
        $imagePath=($this->image) ?  $this->image : '61c72d4cce05a-tamimjd.jpg';
        return '/images/'. $imagePath;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
