<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'section_name',
								'department_fk',
								'is_active'
								//
								);

	public function department()
	{
		return $this->belongsTo('App\Department','department_fk');
	}
}
