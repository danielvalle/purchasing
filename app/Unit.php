<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'unit_name',
								'is_active'
								//
								);
}
