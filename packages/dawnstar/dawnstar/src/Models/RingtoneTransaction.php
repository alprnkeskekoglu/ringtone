<?php

namespace Dawnstar\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RingtoneTransaction extends Model
{
    protected $table = 'ringtone_transactions';
    public $timestamps = true;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'user_id',
        'ringtones',
        'total',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getRingtoneCountAttribute()
    {
        return count(json_decode($this->ringtones, 1));
    }

}
