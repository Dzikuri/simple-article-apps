<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'article_category';

    protected $fillable = [
        'id',
        'title',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all of the comments for the ArticleCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function article(): HasMany
    {
        return $this->hasMany(Article::class, 'id', 'category_id');
    }
}
