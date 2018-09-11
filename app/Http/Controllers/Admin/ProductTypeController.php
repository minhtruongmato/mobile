<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\DB\DbProductTypeRepository;
use App\Repositories\Eloquents\OrmProductTypeRepository;
use App\Http\Requests\ProductTypeRequest;
use Session;
use DateTime;

class ProductTypeController extends Controller
{
    protected $dbProductTypeRepository;
    protected $ormProductTypeRepository;
    public function __construct(
        DbProductTypeRepository $dbProductTypeRepository,
        OrmProductTypeRepository $ormProductTypeRepository
    )
    {
        $this->dbProductTypeRepository = $dbProductTypeRepository;
        $this->ormProductTypeRepository = $ormProductTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $keyword = '';
        // $keyword = $request->keyword;
        // $result = $this->ormProductTypeRepository->search_and_paginate($keyword, 10);
        $result = $this->ormProductTypeRepository->paginate(10);
        foreach ($result as $key => $value) {
            if ($value['parent_id'] == 0) {
                $result[$key]['parent_title'] = 'Danh mục gốc';
            }else{
                $result[$key]['parent_title'] = $this->ormProductTypeRepository->find_by_parent_id($value['parent_id'])['title'];
            };
            
        }
        // $result->setPath('product_type?keyword='.$keyword);
        
        return view('admin.product_type.index', ['result' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result = $this->ormProductTypeRepository->all();
        return view('admin.product_type.create', ['category' => $result]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductTypeRequest $request)
    {
        $uniqueSlug = $this->createSlug('type_products', $request->slug);
        $data = [
            'title' => $request->title,
            'slug' => $uniqueSlug,
            'parent_id' => $request->parent_id,
            'created_at' => new DateTime()
        ];
        $insert = $this->dbProductTypeRepository->save($data);
        if($insert){
            Session::flash('success', 'Thêm mới danh mục thành công!');
            return redirect()->intended('admin/product_type');
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail = $this->ormProductTypeRepository->find($id);
        $category = $this->ormProductTypeRepository->get_all_not_by_id($id);
        return view('admin.product_type.edit', ['category' => $category, 'detail' => $detail]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductTypeRequest $request, $id)
    {
        $uniqueSlug = $this->createSlug('type_products', $request->slug, $id);
        $data = [
            'title' => $request->title,
            'slug' => $uniqueSlug,
            'parent_id' => $request->parent_id
        ];
        $update = $this->ormProductTypeRepository->update($id, $data);
        if($update){
            Session::flash('success', 'Cập nhật danh mục thành công!');
            return redirect()->intended('admin/product_type');
        }else{
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function remove($id)
    {
        $countCategoryChildren = $this->ormProductTypeRepository->count_all_with_parent_id($id);
        if($countCategoryChildren > 0){
            return response()->json([
                'status' => 200,
                'isExist' => false,
                'message' => 'Xóa danh mục thất bại do danh mục chứa danh mục con hoặc bài viết!'
            ]);
        }else{
            $data = ['is_deleted' => 1];
            $update = $this->ormProductTypeRepository->update($id, $data);
            if($update){
                return response()->json([
                    'status' => 200,
                    'isExist' => true,
                    'message' => ''
                ]);
            }else{
                return response()->json([
                    'status' => 200,
                    'isExist' => false,
                    'message' => ''
                ]);
            }
        }
        
    }
}
