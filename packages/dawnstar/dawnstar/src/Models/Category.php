<?php

namespace Dawnstar\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = true;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'status',
        'parent_id',
        'image',
        'name',
        'slug',
        'detail',
    ];

    public function tags() {
        return $this->hasMany(Tag::class);
    }
    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function parent() {
        return $this->belongsTo(Category::class, 'id', 'parent_id');
    }

}
