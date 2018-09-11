<?php 

namespace App\Repositories\Eloquents;
use App\Banner;

class OrmBannerRepository
{
	public function find($id)
	{
		return Banner::find($id);
	}

	public function paginate($paginate)
	{
		return Banner::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function update($id, $data)
	{
		return Banner::where('id', $id)->update($data);
	}

	public function save($data)
	{
		return Banner::create($data);
	}
}