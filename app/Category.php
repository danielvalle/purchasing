<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'category_name',
								'is_active'
								//
								);

}
