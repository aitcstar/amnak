<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPerson extends Model
{
    use HasFactory;
    public $table='project_persons';

    protected $fillable = [
        'project_id',
        'person_id',
        'role',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_persons')
                    ->withPivot('role')
                    ->withTimestamps();
    }
}
