<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockCard extends Model
{
    protected $table = 'stock_card';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'item_fk',
								'date',
								'reference',
								'po_fk',
								'acceptance_fk',
								'issuance_fk',
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
