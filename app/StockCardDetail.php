<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockCardDetail extends Model
{
    protected $table = 'stock_card_detail';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'date',
								'reference_fk',
								'reference_no',
								'received_quantity',
								'issued_quantity',
								'office_fk',
								'balanced_quantity',
								'no_of_days_consume',
								'is_active'
								//
								);
}
