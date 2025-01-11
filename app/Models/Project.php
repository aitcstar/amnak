<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duration',
        'locations',
        'budget',
        'members_count',
        'shifts_count',
        'company_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

   /* public function persons()
    {
        return $this->hasMany(ProjectPerson::class);
    }
*/
    public function persons()
    {
        return $this->belongsToMany(Person::class, 'project_persons')
                    ->withPivot('role')
                    ->withTimestamps();
    }

}
