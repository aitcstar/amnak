<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Person extends Authenticatable
{
    use Notifiable;

    public $table='persons';

    protected $fillable = [
        'first_name',
        'last_name',
        'national_id',
        'date_of_birth',
        'height',
        'weight',
        'qualifications',
        'id_image',
        'password',
        'salary',
        'company_id',
        'job_number',
        'gender'
    ];

    // Relationship with the Company model
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    // تعريف العلاقة مع الصور
    public function images()
    {
        return $this->hasMany(PersonImage::class, 'person_id', 'id'); // تأكد من العمود الصحيح
    }
}
