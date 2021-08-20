<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * @package App\Models
 * @mixin Builder
 */

class Country extends Model
{
    protected $table = 'country';
    protected $primaryKey = 'Code';
    public $incrementing = false;
    protected $keyType = 'string';
}
