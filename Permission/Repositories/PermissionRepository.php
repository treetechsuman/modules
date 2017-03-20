<?php
namespace Modules\Permission\Repositories;

interface PermissionRepository {

	function create(array $attributes);

	function update($id,array $attributes);

	function delete($id);

	function getById($id);

	function getAll();

}