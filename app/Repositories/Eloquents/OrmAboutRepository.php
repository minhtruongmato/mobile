<?php 

namespace App\Repositories\Eloquents;
use App\Repositories\Contracts\AboutRepositoryInterface;
use App\About;

class OrmAboutRepository implements AboutRepositoryInterface
{
	public function find($id)
	{
		return About::find($id);
	}

	public function paginate($paginate)
	{
		return About::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function update($id, $data)
	{
		return About::where('id', $id)->update($data);
	}
}