<?php
namespace Modules\Permission\Repositories;

use Modules\Permission\Entities\Permission;
use Session;
use Hash;
use DB;

/**
* 
*/
class EloquentPermission implements PermissionRepository
{
	private $permission;

	public function __construct(Permission $permission)
	{
		$this->permission = $permission;
	}
	public function getAll(){
		return $this->permission->all();
	}

	public function create(array $attributes){
		return $this->permission->create($attributes);
	}
	public function update($id,array $attributes){
		return $this->permission->findorfail($id)->update($attributes);
	}

	public function delete($id){
		return $this->permission->findorfail($id)->delete();
	}

	public function getById($id){
		return $this->permission->findorfail($id);
	}
	
}
