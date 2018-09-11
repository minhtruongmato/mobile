<?php 

namespace App\Repositories\DB;
// use App\Repositories\Contracts\ProductTypeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DbOrderRepository
{
	public function find($id)
	{
		return DB::table('order')->where('id', $id)->first();
	}

	public function paginate($paginate)
	{
		return DB::table('order')->orderBy('id')->paginate($paginate);
	}

	public function update($id, $data)
	{
		return DB::table('order')->where('id', $id)->update($data);
	}

	public function save($data)
	{
		return DB::table('order')->insert($data);
	}
}