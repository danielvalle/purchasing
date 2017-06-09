<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockCard extends Model
{
    protected $table = 'stock_card';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'item_fk',
								'stock_card_description',
								'stock_card_no',
								'is_active'
								//
								);
}
