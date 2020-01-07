<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Backendr extends Model
{
    protected $fillable = [
        'date', 'accounthead','description','debit','credit','cashbalance'
    ];
}                                                                                                       

