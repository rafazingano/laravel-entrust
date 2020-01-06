<?PHP

namespace ConfrariaWeb\Entrust\Services;

use ConfrariaWeb\Entrust\Contracts\PermissionContract;
use ConfrariaWeb\Vendor\Traits\ServiceTrait;

class PermissionService
{

    use ServiceTrait;

    public function __construct(PermissionContract $permission)
    {
        $this->obj = $permission;
    }

}
