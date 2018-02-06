<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;
use Signes\Acl\GroupInterface;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Group
 *
 * @package    App\Models
 */
class Group extends Model implements GroupInterface
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
     * Mass fillable columns
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'acl_groups';

    /**
     * User group permissions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getPermissions()
    {
        return $this->belongsToMany(
            "{$this->namespace}\\Models\\Acl\\Permission",
            'acl_group_permissions',
            'group_id',
            'permission_id'
        )->withPivot('actions')->withTimestamps();
    }

    /**
     * Get group roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getRoles()
    {
        return $this->belongsToMany(
            "{$this->namespace}\\Models\\Acl\\Role",
            'acl_group_roles',
            'group_id',
            'role_id'
        )->withTimestamps();
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
}
