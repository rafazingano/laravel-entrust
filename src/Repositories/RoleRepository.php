<?PHP

namespace ConfrariaWeb\Acl\Repositories;

use ConfrariaWeb\Acl\Contracts\RoleContract;
use ConfrariaWeb\Acl\Models\Role;
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
