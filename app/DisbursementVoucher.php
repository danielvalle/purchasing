<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisbursementVoucher extends Model
{
    protected $table = 'disbursement_voucher';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'dv_number',
								'mode_of_payment',
								'others',
								'date',
								'entity_fk',
      							'fund_cluster',
								'payee_fk',
								'employee_no',
								'ors_bur_no',
								'address',
								'certified',
								'certifier_fk',
								'certifier_designation_fk',
								'certifier_expense_fk',
								'certifier_expense_designation_fk',
								'certified_date',
								'approved_for_payment',
								'approver_fk',
								'approver_designation_fk',
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
