<?php 

namespace App\Repositories\DB;
use App\Repositories\Contracts\AboutRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DbAboutRepository implements AboutRepositoryInterface
{
	public function find($id)
	{
		return DB::table('about')->where('id', $id)->first();
	}

	public function paginate($paginate)
	{
		return DB::table('about')->where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function update($id, $data)
	{
		return DB::table('about')->where('id', $id)->update($data);
	}
}