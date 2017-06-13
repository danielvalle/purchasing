<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbstractQuotation extends Model
{
    protected $table = 'abstract_quotation';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'date',
								'supervising_admin_fk',
								'admin_officer_fk',
								'admin_officer_2_fk',
								'board_secretary_fk',
								'vpaf_fk',
								'approve_fk',
								'pr_fk',
								'is_active'
								//
								);

	public function detail()
	{
		return $this->hasMany('App\AbstractQuotationDetail','abstract_quotation_fk','id');
	}

}
