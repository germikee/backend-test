<?php

namespace App\Models;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
    ];

    /**
     * Get author's news articles.
     */
    public function news()
    {
        return $this->hasMany(News::class);
    }

    /**
     * Get the author's full name.
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
