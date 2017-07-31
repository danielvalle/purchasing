<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisbursementVoucherAccounting extends Model
{
    protected $table = 'disbursement_voucher_accounting';
    
    protected $primaryKey = 'id';
    protected $fillable = array('id',
                                'dv_fk',
                                'accounting_title',
                                'uacs_code',
                                'debit',
                                'credit',
                                'is_active',
                                'created_at',
                                'updated_at',
                                );
}
