<?PHP

namespace ConfrariaWeb\Entrust\Repositories;

use ConfrariaWeb\Entrust\Contracts\RoleContract;
use ConfrariaWeb\Entrust\Models\Role;
use ConfrariaWeb\Vendor\Traits\RepositoryTrait;

class RoleRepository implements RoleContract
{

    use RepositoryTrait;

    function __construct(Role $role)
    {
        $this->obj = $role;
    }

    protected function syncs($obj, $data)
    {
        if (isset($data['permissions'])) {
            $obj->permissions()->sync($data['permissions']);
        }
        if (isset($data['stepWhenCreatingUser'])) {
            $obj->stepWhenCreatingUser()->sync($data['stepWhenCreatingUser']);
        }

        if (isset($data['steps'])) {
            $obj->steps()->sync($data['steps']);
        }

        if (isset($data['tasksStatuses'])) {
            $obj->tasksStatuses()->sync($data['tasksStatuses']);
        }

        if (isset($data['usersStatuses'])) {
            $obj->usersStatuses()->sync($data['usersStatuses']);
        }

        if (isset($data['usersRoles'])) {
            $obj->usersRoles()->sync($data['usersRoles']);
        }

    }

}
