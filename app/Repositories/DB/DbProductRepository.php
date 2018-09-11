<?php 

namespace App\Repositories\DB;
// use App\Repositories\Contracts\ProductTypeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DbProductRepository
{
	public function find($id)
	{
		return DB::table('products')->where('id', $id)->first();
	}

	public function paginate($paginate)
	{
		return DB::table('products')->where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function update($id, $data)
	{
		return DB::table('products')->where('id', $id)->update($data);
	}

	public function save($data)
	{
		return DB::table('products')->insert($data);
	}
}