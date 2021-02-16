<?php

namespace App\Models;

use App\Models\Discipline;
use App\Models\Summary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'discipline_id',
        'title'
    ];

    /**
     * @return BelongsTo
     */
    public function discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class);
    }

    /**
     * @return HasMany
     */
    public function summaries(): HasMany
    {
        return $this->hasMany(Summary::class);
    }
}
