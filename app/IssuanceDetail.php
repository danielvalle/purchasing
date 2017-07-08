<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssuanceDetail extends Model
{
    protected $table = 'issuance_detail';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'issuance_number',
								'issuance_fk',
								'stock_no',
								'unit_fk',
								'item_fk',
								'quantity',
								'no_of_days_consume',
								'remarks',
								'is_active'
								//
								);
}
