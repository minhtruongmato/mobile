<?php 

namespace App\Repositories\Eloquents;
// use App\Repositories\Contracts\AboutRepositoryInterface;
use App\Product;

class OrmProductRepository
{
	public function find($id)
	{
		return Product::where(['is_deleted' =>  0, 'id' => $id])->first();
	}

	public function paginate($paginate)
	{
		return Product::where('is_deleted', 0)->orderBy('id', 'desc')->paginate($paginate);
	}

	public function search_and_paginate($keyword ='', $paginate)
	{
		return Product::whereExists(function ($query) use ($keyword){
            $query->where('is_deleted', 0);
            if($keyword != ''){
                $query->where('title', 'like', '%'.$keyword.'%');
            }
        })->paginate($paginate);
	}

	public function search_and_paginate_with_type_product($keyword ='', $paginate)
	{
		return Product::with('type_product')->whereExists(function ($query) use ($keyword){
            $query->where('is_deleted', 0);
            if($keyword != ''){
                $query->where('title', 'like', '%'.$keyword.'%');
            }
        })->paginate($paginate);
	}

	public function all()
	{
		return Product::where('is_deleted', 0)->get();
	}

	public function get_by_slug($slug='')
	{
		return Product::where(['is_deleted' => 0, 'slug' => $slug])->first();
	}

	public function get_by_slug_with_template($slug='')
	{
		return Product::where(['is_deleted' => 0, 'slug' => $slug])->with('template')->first();
	}

	public function get_all_not_by_id($id){
		return Product::where('id', '!=', $id)->where('is_deleted', 0)->get();
	}

	public function update($id, $data)
	{
		return Product::where('id', $id)->update($data);
	}

	public function save($data)
	{
		return Product::create($data);
	}

	public function find_by_parent_id($parent_id='')
	{
		return Product::where('id', $parent_id)->where('is_deleted', 0)->first();
	}

	public function get_by_type_id($type_id, $paginate)
	{
		return Product::where('type_id', $type_id)->where('is_deleted', 0)->paginate($paginate);
	}

	public function count_all_by_type_id($type_id='')
	{
		return Product::where('type_id', $type_id)->where('is_deleted', 0)->count();
	}

	public function get_products_by_discounted($paginate)
	{
		return Product::where('discount', '<>', 0)->where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}
}