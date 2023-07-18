<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public function country() {
        return $this->belongsTo(Country::class , 'country_id' , 'id');
    }

    public function users() {
        return $this->hasMany(User::class);
    }

    public function actor() {
        return $this->morphTo();
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
