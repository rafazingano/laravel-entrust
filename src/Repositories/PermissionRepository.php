<?PHP

namespace ConfrariaWeb\Acl\Repositories;

use ConfrariaWeb\Acl\Contracts\PermissionContract;
use ConfrariaWeb\Acl\Models\Permission;
use ConfrariaWeb\Vendor\Traits\RepositoryTrait;

class PermissionRepository implements PermissionContract
{

    use RepositoryTrait;

    function __construct(Permission $permission)
    {
        $this->obj = $permission;
    }


}
