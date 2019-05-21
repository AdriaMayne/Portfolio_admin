<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    protected $table = 'project';
    protected $primaryKey = 'id';
    public $incrementing = 'true';
    protected $keyType = 'int';
    public $timestamps = false;

    public function tags(){
        return $this->belongsToMany('App\Models\Tag', 'project_tag', 'project_id', 'tag_id');
    }
}
