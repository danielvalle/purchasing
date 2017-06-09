<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbstractQuotationDetail extends Model
{
    protected $table = 'abstract_quotation_detail';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'abstract_quotation_fk',
								'item_no',
								'unit_fk',
								'item_fk',
								'supplier1_amount',
								'supplier1_total',
								'supplier2_amount',
								'supplier2_total',
								'supplier3_amount',
								'supplier3_total',
								'supplier4_amount',
								'supplier4_total',
								'supplier5_amount',
								'supplier5_total',
								'quantity',
								'is_active'
								//
								);

	public function aq()
	{
		return $this->belongsTo('App\AbstractQuotation','abstract_quotation_fk');
	}

}
