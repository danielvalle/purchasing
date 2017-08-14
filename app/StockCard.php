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
								'received_quantity_unit',
								'issued_quantity',
								'issued_quantity_unit',
								'office_fk',
								'balanced_quantity',
								'balanced_quantity_unit',
								'no_of_days_consume',
								'is_active'
								//
								);
}
