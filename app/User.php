<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * Application namespace
     *
     * @var string
     */
    protected $namespace = "App";

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * [$dates description]
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Search
     * @param  [type] $query    [description]
     * @param  [type] $keyword  [description]
     * @param  [type] $searchBy [description]
     * @return [type]           [description]
     */
    public function scopeSearch($query, $searchBy, $keyword)
    {
        return $query->where($searchBy, $keyword);
    }

    /**
     * Get List with Status
     * @param  [type] $query  [description]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * [video description]
     * @return [type] [description]
     */
    public function video()
    {
        return $this->hasMany('App\Models\Video', 'user_id');
    }
}