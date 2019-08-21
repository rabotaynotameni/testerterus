<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function projects()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }


    protected $hidden = [
        'id','project_id'
    ];


    protected $fillable = [
        'project_id','description'
    ];

    protected $guarded = [
        'id'
    ];

   

}
