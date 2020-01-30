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

    public function where(array $data, $take = null, $skip = false, $select = false)
    {

        if (isset($data['id'])) {
            $this->obj = $this->obj->where('id', $data['id']);
        }

        if (isset($data['name'])) {
            $this->obj = $this->obj->where('name', 'like', '%' . $data['name'] . '%');
        }

        if (isset($data['display_name'])) {
            $this->obj = $this->obj->where('display_name', 'like', '%' . $data['display_name'] . '%');
        }

        return $this;
    }

}
