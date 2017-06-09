<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $table = 'office';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'office_name',
								'is_active'
								//
								);
}
