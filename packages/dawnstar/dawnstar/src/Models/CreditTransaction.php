<?php

namespace Dawnstar\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditTransaction extends Model
{
    protected $table = 'credit_transactions';
    public $timestamps = true;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'user_id',
        'credit',
        'amount',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
