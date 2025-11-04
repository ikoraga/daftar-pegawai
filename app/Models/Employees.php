<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasOne};
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Employees extends Model
{
    use SoftDeletes, HasUlids;

    protected $fillable = [
        'nip',
        'full_name',
        'birth_place',
        'birth_date',
        'address',
        'phone',
        'npwp',
        'gender',
        'religion_id',
        'rank_id',
        'echelon_id',
        'position_id',
        'unit_id',
        'photo_path',
    ];
    protected $hidden = [
        'updated_at',
        'deleted_at',
        'created_at'
    ];

    public function position(): BelongsTo
    {
        return $this->belongsTo(Positions::class, 'position_id', 'id');
    }

    public function religion(): BelongsTo
    {
        return $this->belongsTo(Religions::class, 'religion_id', 'id');
    }

    public function rank(): BelongsTo
    {
        return $this->belongsTo(Ranks::class, 'rank_id', 'id');
    }
    public function echelon(): BelongsTo
    {
        return $this->belongsTo(Echelons::class, 'echelon_id', 'id');
    }
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Units::class, 'unit_id', 'id');
    }
}
