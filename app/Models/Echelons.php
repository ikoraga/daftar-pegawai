<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Echelons extends Model
{
    use SoftDeletes, HasUlids;

    protected $fillable = [
        'kode',
        'name',
    ];
    public function employees(): HasMany
    {
        return $this->hasMany(Employees::class);
    }
}
