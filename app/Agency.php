<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = 'agency';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'agency_name',
								'department_fk',
								'is_active'
								//
								);

	public function users()
	{
		return $this->hasMany('App\User','agency_fk','id');
	}
}
