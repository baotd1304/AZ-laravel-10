<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'canonical',
        'image',
        'user_id',
        'publish'
    ];
    
    protected $attributes = [
        // 'user_id' => 1,

    ];

    public function postCatalogues()
    {
        return $this->belongsToMany(PostCatalogue::class)->withPivot(
            'name',
            'description',
            'content'
        );;
    }
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
