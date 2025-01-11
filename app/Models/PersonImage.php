<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PersonImage extends Model
{
    protected $fillable = ['person_id', 'image_path'];

    // تعريف العلاقة مع الشخص
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id', 'id'); // تأكد من العمود الصحيح
    }
}
