<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title','description','slug'
    ];

    protected $guarded = [
        'id'
    ];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
