<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisbursementVoucherDetail extends Model
{
    protected $table = 'disbursement_voucher_detail';
    
    protected $primaryKey = 'id';
    protected $fillable = array('id',
                                'dv_fk',
                                'particulars',
                                'responsibility_center',
                                'mfo_pap',
                                'amount',
                                'is_active',
                                'created_at',
                                'updated_at',
                                );
}
