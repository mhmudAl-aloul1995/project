<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property Article[] $home
 * @property Link[] $links
 * @property Material[] $materials
 * @property MaterialsPlaylist[] $materialsPlaylists
 * @property Playlist[] $playlists
 * @property Project[] $projects
 * @property Subplaylist[] $subplaylists
 */


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'address','img', 'email','phone', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at'];

    public function researches()
    {
        return $this->hasMany('App\Research');
    }

}
