<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table = 'purchase_order';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'agency_fk',
								'po_number',
								'supplier_fk',
								'address',
								'tin',
								'invoice_date',
								'mode_of_procurement',
								'place_of_delivery',
								'date_of_delivery',
								'delivery_term',
								'payment_term',
								'funds_available',
								'total_amount',
								'total_amount_in_words',
								'authorized_official_fk',
								'authorized_official_designation_fk',
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
