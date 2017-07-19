<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestForQuote extends Model
{
    protected $table = 'request_for_quote';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'date',
								'rfq_number',
								'supplier1_fk',
								'supplier2_fk',
								'supplier3_fk',
								'supplier4_fk',
								'supplier5_fk',
								'vat_nonvat_tin',
								'place_of_delivery',
								'within_no_of_days',
								'requestor_fk',
								'requestor_designation_fk',
								'canvasser_fk',
								'canvasser_designation_fk',
								'pr_fk',
								'is_active'
								//
								);

	public function detail()
	{
		return $this->hasMany('App\RequestForQuoteDetail','request_for_quote_fk','id');
	}
	
}
