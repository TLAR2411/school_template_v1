<?php

namespace App\Models\Core;

use App\Models\Accounting\CashDenomination;
use App\Models\Accounting\CashDenominationType;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'currency_code',
        'name_kh',
        'name_en',
        'abbr',
        'exchange_rate',
        'default',
        'is_active'
    ];

    public function cashDenominationTypes()
    {
        return $this->hasMany(CashDenominationType::class);
    }

    public function cashDenomination()
    {
        return $this->hasMany(CashDenomination::class, 'currency_id', 'id');
    }
}
