<?php 

namespace App\Repositories\Eloquents;
use App\Customer;

class OrmCustomerRepository
{
	public function find($id)
	{
		return Customer::find($id);
	}

	public function paginate($paginate)
	{
		return Customer::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function update($id, $data)
	{
		return Customer::where('id', $id)->update($data);
	}

	public function save($data)
	{
		return Customer::create($data);
	}
}