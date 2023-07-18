<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viewer extends Model
{
    use HasFactory;
    public function user() {
        return $this->morphOne(User::class , 'actor' , 'actor_type' , 'actor_id' , 'id');
    }

    //full_name
    public function getFullNameAttribute()
    {
        return $this->user->firstname . " " . $this->user->lastname;

    }

    public function getImageAttribute()
    {
        return $this->user->image;

    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($admin){
            $admin->user()->delete();
        });
      }
}

