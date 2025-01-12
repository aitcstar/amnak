<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'leave_type',
        'start_date',
        'end_date',
        'reason',
        'status',
        'company_id',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
