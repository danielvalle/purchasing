<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'supplier_name',
								'is_active'
								//
								);
}
