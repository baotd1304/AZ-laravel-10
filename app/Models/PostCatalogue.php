<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCatalogue extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'parentId',
        'left',
        'right',
        'level',
        'image',
        'icon',
        'album',
        'publish',
        'order'
    ];
    
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class)->withPivot(
            'name',
            'description',
            'content'
        );
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    
}
