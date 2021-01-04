<?php

namespace App\Models;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'author_id',
        'article',
        'is_published'
    ];

    /**
     * Get author of news article.
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Scope a query to only include news created before at a date.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $from
     * @param  string  $to
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublishedBetween($query, $from, $to)
    {
        return $query->whereBetween('created_at', [Carbon::parse($from)->startOfDay(), Carbon::parse($to)->endOfDay()]);
    }
}
