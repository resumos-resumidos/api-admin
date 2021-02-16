<?php

namespace App\Models;

use App\Models\Content;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Summary extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'title',
        'free'
    ];

    /**
     * @return BelongsTo
     */
    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}
