<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcceptanceDetail extends Model
{
    protected $table = 'acceptance_detail';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'item_fk',
								'item',
								'unit_fk',
								'description',
								'quantity',
								'is_active'
								//
								);
}
