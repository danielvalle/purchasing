<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'department_name',
								'is_active'
								//
								);

	public function sections()
	{
		return $this->hasMany('App\Department','department_fk','id');
	}
}
