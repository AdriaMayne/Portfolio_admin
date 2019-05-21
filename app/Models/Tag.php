<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
    protected $table = 'tag';
    protected $primaryKey = 'id';
    public $incrementing = 'true';
    protected $keyType = 'int';
    public $timestamps = false;

    public function projects(){
        return $this->belongsToMany('App\Models\Project', 'project_tag', 'tag_id', 'project_id');
    }
}
