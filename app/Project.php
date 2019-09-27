<?php

namespace App;

use App\Events\ProjectCreated;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];


    protected $dispatchesEvents = [
        'created' => ProjectCreated::class
    ];


    public function owner()
    {
        return $this->belongsTo(User::class);
    }


    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function addTask($task)
    {
        $this->tasks()->create($task);
    }

    
}
