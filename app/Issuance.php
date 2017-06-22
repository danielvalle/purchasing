<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issuance extends Model
{
    protected $table = 'issuance';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'agency_fk',
								'department_fk',
								'office_fk',
								'reasonability_center_code',
								'ris_no',
								'ris_date',
								'sai_no',
								'sai_date',
								'purpose',
								'requested_by_fk',
								'requestor_designation_fk',
								'request_date',
								'approver_fk',
								'approver_designation_fk',
								'approved_date',
								'issued_by_fk',
								'issuer_designation_fk',
								'issued_date',
								'received_by_fk',
								'recipient_designation_fk',
								'receipt_date',
								'is_active'
								//
								);
}
