<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $category_id
 * @property integer $user_id
 * @property string $jr_name
 * @property string $editorial_board
 * @property string $editorial_board_vice
 * @property boolean $active
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Category $category
 * @property User $user
 * @property JournalMember[] $journalMembers
 * @property Research[] $researches
 */
class Journal extends Model
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
    protected $fillable = ['category_id', 'user_id', 'jr_name', 'editorial_board', 'editorial_board_vice', 'active', 'created_at', 'updated_at', 'deleted_at'];

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
    public function editorial_board()
    {
        return $this->belongsTo('App\User', 'editorial_board', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function editorial_board_vice()
    {
        return $this->belongsTo('App\User', 'editorial_board_vice', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function journalMembers()
    {
        return $this->hasMany('App\JournalMember');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function researches()
    {
        return $this->hasMany('App\Research');
    }
}
