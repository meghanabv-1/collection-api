<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Backend extends Model
{
    protected $fillable = [
        'date', 'accounthead','description','debit','credit','cashbalance'
    ];
}
