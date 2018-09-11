<?php 

namespace App\Repositories\Contracts;

interface TeamsRepositoryInterface
{
	public function find($id);
	public function paginate($id);
	public function update($id, $data);
	public function save($data);
}