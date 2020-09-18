<?PHP

namespace ConfrariaWeb\Acl\Services;

use ConfrariaWeb\Acl\Contracts\PermissionContract;
use ConfrariaWeb\Vendor\Traits\ServiceTrait;

class PermissionService
{

    use ServiceTrait;

    public function __construct(PermissionContract $permission)
    {
        $this->obj = $permission;
    }

}
