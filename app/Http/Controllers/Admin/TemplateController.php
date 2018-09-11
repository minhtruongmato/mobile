<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\OrmTemplateRepository;
use App\Repositories\DB\DbTemplateRepository;
use Illuminate\Support\Facades\DB;
use Session;
use DateTime;

class TemplateController extends Controller
{
    protected $ormTemplateRepository;
    protected $dbTemplateRepository;

    public function __construct(
        OrmTemplateRepository $ormTemplateRepository,
        DbTemplateRepository $dbTemplateRepository
    )
    {
        $this->ormTemplateRepository = $ormTemplateRepository;
        $this->dbTemplateRepository = $dbTemplateRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = '';
        $keyword = $request->keyword;
        $templates =$this->ormTemplateRepository->search_and_paginate($keyword, 10);
        $templates->setPath('template?keyword='.$keyword);
        return view('admin.template.index', ['templates' => $templates, 'keyword' => $keyword]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.template.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->title ==null){
            Session::flash('error', 'Vui lòng nhập đầy đủ thông tin!');
            return back();
        }
        $data = [
            'title' => $request->title,
            'content' => json_encode(array_values($request->content)),
            'created_at' => new DateTime()
        ];
        $insert = $this->dbTemplateRepository->save($data);
        if($insert){
            Session::flash('success', 'Thêm mới cấu hình thành công!');
            return redirect()->intended('admin/template');
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
        $detail = $this->ormTemplateRepository->find($id);
        $detail['content'] = json_decode($detail['content']);
        return view('admin.template.detail', ['detail' => $detail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail = $this->ormTemplateRepository->find($id);
        $detail['content'] = json_decode($detail['content']);
        return view('admin.template.edit', ['detail' => $detail]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->title ==null){
            Session::flash('error', 'Vui lòng nhập đầy đủ thông tin!');
            return back();
        }
        $data = [
            'title' => $request->title,
            'content' => json_encode(array_values($request->content))
        ];

        $update = $this->ormTemplateRepository->update($id, $data);
        if($update){
            Session::flash('success', 'Cập Nhật Thành Công!');
            return redirect()->intended('admin/template');
        }else{
            Session::flash('error', 'Cập Nhật Thất Bại!');
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
        $countProduct = DB::table('products')->where('template_id', $id)->count();
        if($countProduct > 0){
            return response()->json([
                'status' => 200,
                'isExist' => false,
                'message' => 'Xóa cấu hình thất bại do cấu hình đang được sử dụng trong sản phẩm!'
            ]);
        }else{
            $data = ['is_deleted' => 1];
            $update = $this->ormTemplateRepository->update($id, $data);
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
