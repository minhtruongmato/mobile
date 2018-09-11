<?php 

namespace App\Repositories\Eloquents;
use App\Order;

class OrmOrderRepository
{
	public function find($id)
	{
		return Order::find($id);
	}

	public function paginate($paginate)
	{
		return Order::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function update($id, $data)
	{
		return Order::where('id', $id)->update($data);
	}

	public function save($data)
	{
		return Order::create($data);
	}
}