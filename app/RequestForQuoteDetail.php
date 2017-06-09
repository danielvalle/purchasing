<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestForQuoteDetail extends Model
{
    protected $table = 'request_for_quote_detail';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'request_for_quote_fk',
								'quantity',
								'unit_fk',
								'item_fk',
								'total',
								'is_active'
								//
								);

	public function rfq()
	{
		return $this->belongsTo('App\RequestForQuote','request_for_quote_fk');
	}

}
