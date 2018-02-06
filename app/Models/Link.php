<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
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
    protected $table = 'link';

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
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
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
     * [user description]
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}