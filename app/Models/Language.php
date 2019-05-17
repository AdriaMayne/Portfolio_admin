<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {
    protected $table = 'languages';
    protected $primaryKey = 'id';
    public $incrementing = 'true';
    protected $keyType = 'int';
    public $timestamps = false;
}
