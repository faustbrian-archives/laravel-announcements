<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Announcements.
 *
 * (c) KodeKeep <hello@kodekeep.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KodeKeep\Announcements\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Config;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Announcement extends Model
{
    use HasSlug;

    protected $fillable = ['author_id', 'title', 'body', 'publish_at'];

    protected $dates = ['publish_at'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Config::get('announcements.models.author'));
    }

    public static function findByslug(string $slug): self
    {
        return static::where('slug', $slug)->firstOrFail();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function getTable(): string
    {
        return Config::get('announcements.tables.announcements');
    }
}
