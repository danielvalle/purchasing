<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $table = 'purchase_request';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'agency_fk',
								'department_fk',
								'section_fk',
								'pr_number',
								'pr_date',
								'sai_number',
								'sai_date',
								'purpose',
								'requested_by_fk',
								'approved_by_fk',
								'is_active'
								//
								);

	public function detail()
	{
		return $this->hasMany('App\PurchaseRequestDetail','purchase_request_fk','id');
	}

}
