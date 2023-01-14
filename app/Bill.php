<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $user_id
 * @property string $bill_date
 * @property boolean $bill_type
 * @property string $discount
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property user $user
 * @property User $user
 * @property BillDetail[] $billDetails
 */
class Bill extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'user_id', 'bill_date', 'bill_type', 'discount', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function billDetails()
    {
        return $this->hasMany('App\BillDetail');
    }
}
