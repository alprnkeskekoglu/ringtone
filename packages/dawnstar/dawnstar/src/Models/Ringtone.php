<?php

namespace Dawnstar\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ringtone extends Model
{
    protected $table = 'ringtones';
    public $timestamps = true;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'status',
        'category_id',
        'type',
        'credit',
        'download_count',
        'name',
        'slug',
        'file',
        'demo_file'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function getTypeStringAttribute() {

        switch ($this->type) {
            case 1:
                return "Monophonic";
            case 2:
                return "Polyphonic";
            case 3:
                return "True Tones";
        }
    }
}
