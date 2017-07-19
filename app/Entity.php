<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'entity';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'entity_name',
								'is_active'
								//
								);

	public function users()
	{
		return $this->hasMany('App\User','entity_fk','id');
	}
}
