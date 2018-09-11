<?php 

namespace App\Repositories\DB;
use Illuminate\Support\Facades\DB;

class DbBannerRepository
{
	public function find($id)
	{
		return DB::table('banners')->where('id', $id)->first();
	}

	public function paginate($paginate)
	{
		return DB::table('banners')->where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function update($id, $data)
	{
		return DB::table('banners')->where('id', $id)->update($data);
	}
	public function save($data)
	{
		return DB::table('banners')->insert($data);
	}
}