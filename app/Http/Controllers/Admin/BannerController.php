<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\DB\DbBannerRepository;
use App\Repositories\Eloquents\OrmBannerRepository;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\Storage;
use Session;
use DateTime;

class BannerController extends Controller
{
    /**
     * [$dbBannerRepository description]
     * @var [type]
     */
    protected $dbBannerRepository;
    protected $ormBannerRepository;

    public function __construct(
        DbBannerRepository $dbBannerRepository,
        OrmBannerRepository $ormBannerRepository
    )
    {
        $this->dbBannerRepository = $dbBannerRepository;
        $this->ormBannerRepository = $ormBannerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/banner/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        // $path = base_path('storage/app/banners');
        $files = $request->file('image');
        $image = $files->store('banners');
        $image = ltrim($image, 'banners/');
        $data = [
            'image' => $image,
            'created_at' => new DateTime()
        ];
        $insert = $this->dbBannerRepository->save($data);
        if($insert){
            Session::flash('success', 'Thêm mới cấu hình thành công!');
            return redirect()->intended('admin/banner');
        }else{
            if(Storage::disk('banners')->exists($image)){
                Storage::delete($image);
            }
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
        //
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
        //
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
}
