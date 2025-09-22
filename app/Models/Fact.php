<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Fact extends Model implements HasMedia
{
    use HasFactory,
        HasTags, InteractsWithMedia;

    protected $fillable = [
        'title',
        'content_old',
        'content_new',
        'published_at',
        'started_at',
        'ended_at',
        'started_at_format',
        'ended_at_format',
        'version',
        'parent_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'version' => 'integer',
        'attribution' => 'json',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Fact::class, 'parent_id');
    }

    public function versions(): HasMany
    {
        return $this->hasMany(Fact::class, 'parent_id')->orderBy('version', 'desc');
    }

    public function latestVersion(): ?Fact
    {
        if ($this->parent_id) {
            return $this->parent->versions()->first();
        }

        return $this->versions()->first() ?? $this;
    }

    public function createNewVersion(array $attributes): Fact
    {
        $parentId = $this->parent_id ?? $this->id;
        $latestVersion = $this->parent_id
            ? $this->parent->versions()->max('version')
            : $this->versions()->max('version');

        return static::create(array_merge($attributes, [
            'parent_id' => $parentId,
            'version' => ($latestVersion ?? $this->version) + 1,
        ]));
    }

    public function scopeLatestVersions($query)
    {
        return $query->whereNull('parent_id')
            ->orWhereIn('id', function ($subQuery) {
                $subQuery->selectRaw('MAX(id)')
                    ->from('facts')
                    ->whereNotNull('parent_id')
                    ->groupBy('parent_id');
            });
    }

    public function scopePublished($query)
    {
        return $query
            ->whereNotNull('published_at');
    }
}
