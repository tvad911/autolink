<?php
namespace App\Models\Acl;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Signes\Acl\UserInterface as SignesAclUserInterface;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 *
 * @package    App\Models
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract, SignesAclUserInterface
{

    use Authenticatable, CanResetPassword;
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
    protected $table = 'acl_users';

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
        'name', 'email', 'password', 'username', 'group_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * User personal permissions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getPermissions()
    {
        return $this->belongsToMany(
            "{$this->namespace}\\Models\\Acl\\Permission",
            'acl_user_permissions',
            'user_id',
            'permission_id'
        )->withPivot('actions')->withTimestamps();
    }

    /**
     * Get user roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getRoles()
    {
        return $this->belongsToMany(
            "{$this->namespace}\\Models\\Acl\\Role",
            'acl_user_roles',
            'user_id',
            'role_id'
        )->withTimestamps();
    }

    /**
     * Get user group
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getGroup()
    {
        return $this->hasOne("{$this->namespace}\\Models\\Acl\\Group", 'id', 'group_id');
    }

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

    /**
     * [generateToken description]
     * @return [type] [description]
     */
    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }
}