<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $category_id
 * @property integer $version_id
 * @property integer $user_id
 * @property string $res_title
 * @property string $res_summary
 * @property string $res_link
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Category $category
 * @property User $user
 * @property Version $version
 * @property Keyword[] $keywords
 */
class Research extends Model
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
    protected $fillable = ['category_id', 'version_id', 'user_id', 'res_title', 'res_summary', 'res_link', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function version()
    {
        return $this->belongsTo('App\Version');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function keywords()
    {
        return $this->hasMany('App\Keyword');
    }
}
