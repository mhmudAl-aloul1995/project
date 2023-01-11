<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $bill_id
 * @property integer $product_id
 * @property integer $user_id
 * @property string $quantity
 * @property string $price_purch
 * @property string $price_sale_defult
 * @property string $price_sale
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Bill $bill
 * @property Product $product
 * @property User $user
 */
class BillDetails extends Model
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
    protected $fillable = ['bill_id', 'product_id', 'user_id', 'quantity', 'price_purch', 'price_sale_defult', 'price_sale', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bill()
    {
        return $this->belongsTo('App\Bill');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
