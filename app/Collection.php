<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
        'user_id', 'date', 'account_head', 'description', 'type', 'amount', 'cash_balance'
    ];
}
