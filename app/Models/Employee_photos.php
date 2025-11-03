<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Employee_photos extends Model
{
    use SoftDeletes, HasUlids;

    protected $fillable = [
        'employee_id',
        'photo_path',
        'isCurrent',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employees::class);
    }
}
