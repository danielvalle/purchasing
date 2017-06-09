<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisbursementVoucher extends Model
{
    protected $table = 'disbursement_voucher';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'mode_of_payment',
								'payee_fk',
								'employee_no',
								'or_bur_no',
								'address',
								'project',
								'code',
								'explanation',
								'amount',
								'certified',
								'certifier_name_fk',
								'date',
								'approved_for_payment',
								'approver_fk',
								'approve_date',
								'ada_no',
								'payment_check_date',
								'bank_name',
								'jev_no',
								'check_printed_name_fk',
								'check_date',
								'other_docs',
								'is_active'
								//
								);
}
