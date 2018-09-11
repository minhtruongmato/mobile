<?php 

namespace App\Repositories\DB;
// use App\Repositories\Contracts\ProductTypeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DbCustomerRepository
{
	public function find($id)
	{
		return DB::table('customer')->where('id', $id)->first();
	}

	public function paginate($paginate)
	{
		return DB::table('customer')->orderBy('id')->paginate($paginate);
	}

	public function update($id, $data)
	{
		return DB::table('customer')->where('id', $id)->update($data);
	}

	public function save($data)
	{
		return DB::table('customer')->insert($data);
	}

	public function getInsertId($data)
	{
		return DB::table('customer')->insertGetId($data);
	}
}