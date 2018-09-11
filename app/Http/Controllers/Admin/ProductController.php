<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\OrmProductRepository;
use App\Repositories\Eloquents\OrmProductTypeRepository;
use App\Repositories\Eloquents\OrmTemplateRepository;
use App\Repositories\DB\DbProductRepository;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ProductRequest;
use App\Template;
use Session;
use DateTime;
use File;

class ProductController extends Controller
{
    protected $ormProductRepository;
    protected $dbProductRepository;
    protected $ormProductTypeRepository;
    protected $ormTemplateRepository;

    public function __construct(
        OrmProductRepository $ormProductRepository,
        DbProductRepository $dbProductRepository,
        OrmProductTypeRepository $ormProductTypeRepository,
        OrmTemplateRepository $ormTemplateRepository
    ){
        $this->ormProductRepository = $ormProductRepository;
        $this->dbProductRepository = $dbProductRepository;
        $this->ormProductTypeRepository = $ormProductTypeRepository;
        $this->ormTemplateRepository = $ormTemplateRepository;
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
        $products =$this->ormProductRepository->search_and_paginate_with_type_product($keyword, 10);

        foreach ($products as $key => $value) {
            $products[$key]['template'] = array_combine(json_decode($value->template_title), json_decode($value->template_content));
        }
        $products->setPath('product?keyword='.$keyword);
        return view('admin.product.index', ['products' => $products, 'keyword' => $keyword]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = $this->ormProductTypeRepository->all();
        $template = $this->ormTemplateRepository->all();
        return view('admin.product.create', ['category' => $category, 'template' => $template]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $template_id = $request->template_id;
        $template = $this->ormTemplateRepository->find_by_template_id($template_id);
        $uniqueSlug = $this->createSlug('products', $request->slug, $request->id);
        $path = base_path() . '/' . 'storage/app/products';
        $newFolderPath = $this->buildNewFolderPath($path, $uniqueSlug);
        File::makeDirectory($newFolderPath[1], 0777, true, true);
        $files = $request->file('image');
        foreach ($files as $key => $file) {
            $fileName[$key] = $file->hashName();
            $file->store('products/' . $newFolderPath[0]);
        }

        $image_json = json_encode($fileName);

        $data = [
            'type_id' => $request->type_id,
            'title' => $request->title,
            'slug' => $request->slug,
            'image' => $image_json,
            'price' => str_replace(',','',$request->price),
            'discount' => ($request->discount != '')? str_replace(',','',$request->discount) : 0,
            'description' => $request->description,
            'content' => $request->content,
            'template_title' => $template['content'],
            'template_content' => json_encode($request->template_content),
            'template_id' => $request->template_id,
            'created_at' => new DateTime()
        ];
        $insert = $this->dbProductRepository->save($data);
        if($insert){
            Session::flash('success', 'Thêm mới sản phẩm thành công!');
            return redirect()->intended('admin/product');
        }else{
            Session::flash('error', 'Thêm mới sản phẩm thất bại!');
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
        $category = $this->ormProductTypeRepository->all();
        $template = $this->ormTemplateRepository->all();
        $detail = $this->ormProductRepository->find($id);
        $detail['template'] = array_combine(json_decode($detail->template_title), json_decode($detail->template_content));
        return view('admin.product.edit', ['detail' => $detail ,'category' => $category, 'template' => $template]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $detail = $this->ormProductRepository->find($id);
        $template_id = $request->template_id;
        $template = $this->ormTemplateRepository->find_by_template_id($template_id);
        $uniqueSlug = $this->createSlug('products', $request->slug, $request->id);
        $path = base_path() . '/' . 'storage/app/products';
        if($request->slug != $detail->slug){
            rename($path . '/' . $detail->slug, $path . '/' . $uniqueSlug);
        }

        $data = [
            'type_id' => $request->type_id,
            'title' => $request->title,
            'slug' => $request->slug,
            'price' => str_replace(',','',$request->price),
            'discount' => ($request->discount != '')? str_replace(',','',$request->discount) : 0,
            'description' => $request->description,
            'content' => $request->content,
            'template_title' => $template['content'],
            'template_content' => json_encode($request->template_content),
            'template_id' => $request->template_id,
            'created_at' => new DateTime()
        ];

        $fileName = [];
        $fileName = json_decode($detail->image);

        // Upload image
        if($request->file('image')){
            foreach ($request->file('image') as $key => $file) {
                $fileName[] = $file->hashName();
                $file->store('products/' . $uniqueSlug);
            }
            // print_r($upload);die;
            $image_json = json_encode($fileName);
            $data['image'] = $image_json;
        }

        $update = $this->ormProductRepository->update($id, $data);
        if($update){
            Session::flash('success', 'Cập nhật sản phẩm thành công!');
            return redirect()->intended('admin/product');
        }else{
            Session::flash('error', 'Cập nhật sản phẩm thất bại!');
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

    function buildNewFolderPath($path, $fileName){
        $newPath = $path . '/' . $fileName;
        $newName = $fileName;
        $counter = 1;
        while (file_exists($newPath)) {
            $newName = $fileName . '-' . $counter;
            $newPath = $path . '/' . $newName;
            $counter++;
        }

        return array($newName, $newPath);
    }

    function fetchByTemplate(){
        $template_id = Input::get('template_id');
        $template = $this->ormTemplateRepository->find_by_template_id($template_id);
        if(!$template){
            return response()->json(['template_id' => $template_id, 'status' => '404']);
        }

        $template['content'] = json_decode($template['content']);

        return response()->json(['template' => $template, 'status' => '200']);
    }

    public function remove($id)
    {
        $data = ['is_deleted' => 1];
        $update = $this->ormProductRepository->update($id, $data);
        if($update){
            return response()->json([
                'status' => 200,
                'isExist' => true,
                'message' => 'Xóa thành công!'
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'isExist' => false,
                'message' => 'Xóa thất bại!'
            ]);
        }
    }
}
