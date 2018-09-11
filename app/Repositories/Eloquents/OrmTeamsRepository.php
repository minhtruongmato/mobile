<?php 

namespace App\Repositories\Eloquents;
use App\Repositories\Contracts\TeamsRepositoryInterface;
use App\Teams;

class OrmTeamsRepository implements TeamsRepositoryInterface
{
	public function find($id)
	{
		return Teams::find($id);
	}

	public function paginate($paginate)
	{
		return Teams::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function update($id, $data)
	{
		return Teams::where('id', $id)->update($data);
	}

	public function save($data)
	{
		return Teams::create($data);
	}
}