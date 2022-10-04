<?php

namespace App\Models;

use App\Events\ArticleCreated;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'text',
    ];

    protected $dispatchesEvents = [
        'created' => ArticleCreated::class,
    ];

    /**
     * CreatedAt getter
     *
     * @return Attribute
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::createFromDate($value)->diffForHumans(),
        );
    }

    /**
     * UpdatedAt getter
     *
     * @return Attribute
     */
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::createFromDate($value)->diffForHumans(),
        );
    }

    /**
     * Relation to User
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
