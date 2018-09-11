<?php 

namespace App\Repositories\DB;
// use App\Repositories\Contracts\ProductTypeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DbTemplateRepository
{
	public function find($id)
	{
		return DB::table('templates')->where('id', $id)->where('is_deleted', 0)->first();
	}

	public function paginate($paginate)
	{
		return DB::table('templates')->where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function update($id, $data)
	{
		return DB::table('templates')->where('id', $id)->update($data);
	}

	public function save($data)
	{
		return DB::table('templates')->insert($data);
	}
}