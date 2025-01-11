<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\RequestRole\RequestRole;

class Company extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'new_password',
        'phone',
        'website',
        'address',
        'logo',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function persons()
    {
        return $this->hasMany(Person::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}

