<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory ,  HasRoles , HasApiTokens;

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
