<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'item_name',
								'item_description',
								'item_quantity',
								'is_active'
								//
								);
}
