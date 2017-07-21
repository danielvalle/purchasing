<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbstractQuotation extends Model
{
    protected $table = 'abstract_quotation';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'aq_number',
								'date',
								'supplier1_fk',
								'supplier2_fk',
								'supplier3_fk',
								'supplier4_fk',
								'supplier5_fk',
								'supervising_admin_fk',
								'admin_officer_fk',
								'admin_officer_2_fk',
								'requesting_officer_fk',
						        'board_secretary_fk',
						        'vpaf_fk',
						        'approve_fk',
						        'supervising_admin_designation_fk',
						        'admin_officer_designation_fk',
						        'admin_officer_2_designation_fk',
						        'requesting_officer_designation_fk',
						        'board_secretary_designation_fk',
						        'vpaf_designation_fk',
						      	'approve_designation_fk',
								'pr_fk',
								'is_active'
								//
								);

	public function detail()
	{
		return $this->hasMany('App\AbstractQuotationDetail','abstract_quotation_fk','id');
	}

}
