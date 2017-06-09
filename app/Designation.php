<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $table = 'designation';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'designation_name',
								'is_active'
								//
								);

	public function users()
	{
		return $this->hasMany('App\User','designation_fk','id');
	}
	
}
