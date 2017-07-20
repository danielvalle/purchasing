<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutrightExpense extends Model
{
    protected $table = 'outright_expense';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'item_fk',
								'date',
								'reference',
								'po_fk',
								'acceptance_fk',
								'reference_no',
								'issued_quantity',
								'is_active'
								//
								);
}
