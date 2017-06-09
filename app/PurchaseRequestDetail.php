<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestDetail extends Model
{
    protected $table = 'purchase_request_detail';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'purchase_request_fk',
								'quantity',
								'unit_of_issue_fk',
								'item_fk',
								'category_fk',
								'stock_no',
								'total_cost',
								'is_active'
								//
								);

	public function pr()
	{
		return $this->belongsTo('App\PurchaseRequestDetail','purchase_request_fk');
	}

}
