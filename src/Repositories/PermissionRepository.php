<?PHP

namespace ConfrariaWeb\Entrust\Repositories;

use ConfrariaWeb\Entrust\Contracts\PermissionContract;
use ConfrariaWeb\Entrust\Models\Permission;
use ConfrariaWeb\Vendor\Traits\RepositoryTrait;

class PermissionRepository implements PermissionContract
{

    use RepositoryTrait;

    function __construct(Permission $permission)
    {
        $this->obj = $permission;
    }


}
