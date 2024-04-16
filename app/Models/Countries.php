<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $fillable = ['official_name', 'common_name', 'capital', 'population', 'timezones', 'flag', 'currencies', 'currency_name', 'languages'];

}
