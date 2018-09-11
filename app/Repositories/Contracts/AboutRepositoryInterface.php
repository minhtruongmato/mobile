<?php 

namespace App\Repositories\Contracts;

interface AboutRepositoryInterface
{
	public function find($id);
	public function paginate($id);
	public function update($id, $data);
}