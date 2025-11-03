<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Positions extends Model
{
    use SoftDeletes, HasUlids;

    protected $fillable = [
        'name',
        'description',
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employees::class);
    }
}
