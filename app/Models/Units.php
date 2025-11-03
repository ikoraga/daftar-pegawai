<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Units extends Model
{
    use SoftDeletes, HasUlids;

    protected $fillable = [
        'name',
        'kode',
        'isActive',
        'parent_id',
    ];
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Units::class, 'parent_id');
    }
    public function children(): HasMany
    {
        return $this->hasMany(Units::class, 'parent_id');
    }
    public function employees(): HasMany
    {
        return $this->hasMany(Employees::class);
    }
}
