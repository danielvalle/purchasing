<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table = 'purchase_order_detail';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'po_id_fk',
								'stock_no',
								'unit_fk',
								'item_fk',
								'category_fk',
								'quantity',
								'unit_cost',
								'amount',
								'is_active'
								//
								);

	public function po()
	{
		return $this->belongsTo('App\PurchaseOrder','po_id_fk');
	}

}
