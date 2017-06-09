<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table = 'purchase_order';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'agency_fk',
								'po_no',
								'supplier_fk',
								'address',
								'tin',
								'date',
								'mode_of_procurement',
								'place_of_delivery',
								'date_of_delivery',
								'delivery_term',
								'payment_term',
								'total_amount',
								'authorized_official_fk',
								'alobs_bub_no',
								'amount',
								'pr_no_fk',
								'abstract_quotation_fk',
								'is_active'
								//
								);

	public function detail()
	{
		return $this->hasMany('App\PurchaseOrderDetail','po_id_fk','id');
	}

}
