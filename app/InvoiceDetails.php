<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    protected $fillable = [
        'id_Invoice',
        'invoice_number',
        'product',
        'Section',
        'Status',
        'Value_Status',
        'note',
        'user',
        'Payment_Date',
    ];
}
