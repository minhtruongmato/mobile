<?php 

namespace App\Repositories\Eloquents;
// use App\Repositories\Contracts\AboutRepositoryInterface;
use App\ProductType;

class OrmProductTypeRepository
{
	public function find($id)
	{
		return ProductType::find($id);
	}

	public function paginate($paginate)
	{
		return ProductType::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function search_and_paginate($keyword ='', $paginate)
	{
		return ProductType::whereExists(function ($query) use ($keyword){
            $query->where('is_deleted', 0);
            if($keyword != ''){
                $query->where('title', 'like', '%'.$keyword.'%');
            }
        })->paginate($paginate);
	}

	public function get_by_slug($slug='')
	{
		return ProductType::where(['is_deleted' => 0, 'slug' => $slug])->first();
	}

	public function all()
	{
		return ProductType::where('is_deleted', 0)->get();
	}

	public function get_all_not_by_id($id){
		return ProductType::where('id', '!=', $id)->where('is_deleted', 0)->get();
	}

	public function update($id, $data)
	{
		return ProductType::where('id', $id)->update($data);
	}

	public function save($data)
	{
		return ProductType::create($data);
	}

	public function find_by_parent_id($parent_id='')
	{
		return ProductType::where('id', $parent_id)->where('is_deleted', 0)->first();
	}

	public function get_all_with_parent_id($parent_id='')
	{
		return ProductType::where('parent_id', $parent_id)->where('is_deleted', 0)->get();
	}

	public function count_all_with_parent_id($parent_id='')
	{
		return ProductType::where('parent_id', $parent_id)->where('is_deleted', 0)->count();
	}
}