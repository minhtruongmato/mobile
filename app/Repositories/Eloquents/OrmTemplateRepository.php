<?php 

namespace App\Repositories\Eloquents;
// use App\Repositories\Contracts\AboutRepositoryInterface;
use App\Template;

class OrmTemplateRepository
{
	public function find($id)
	{
		return Template::find($id);
	}

	public function paginate($paginate)
	{
		return Template::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function search_and_paginate($keyword ='', $paginate)
	{
		return Template::whereExists(function ($query) use ($keyword){
            $query->where('is_deleted', 0);
            if($keyword != ''){
                $query->where('title', 'like', '%'.$keyword.'%');
            }
        })->paginate($paginate);
	}

	public function all()
	{
		return Template::where('is_deleted', 0)->get();
	}

	public function get_all_not_by_id($id){
		return Template::where('id', '!=', $id)->where('is_deleted', 0)->get();
	}

	public function update($id, $data)
	{
		return Template::where('id', $id)->update($data);
	}

	public function save($data)
	{
		return Template::create($data);
	}

	public function find_by_template_id($template_id='')
	{
		return Template::where('id', $template_id)->where('is_deleted', 0)->first();
	}

	public function get_all_with_template_id($template_id='')
	{
		return Template::where('template_id', $template_id)->where('is_deleted', 0)->get();
	}

	public function count_all_with_template_id($template_id='')
	{
		return Template::where('parent_id', $parent_id)->where('is_deleted', 0)->count();
	}
}