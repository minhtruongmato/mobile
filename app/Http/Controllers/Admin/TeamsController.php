<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TeamsRepositoryInterface;
use App\Http\Requests\TeamsRequest;
use Session;

class TeamsController extends Controller
{
    protected $teamsRepository;

    public function __construct(
        TeamsRepositoryInterface $teamsRepository
    )
    {
        $this->teamsRepository = $teamsRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->intended('admin/about');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamsRequest $request)
    {
        if($request->image){
            $size = $request->image->getSize();
            if($size > 1572864){
                Session::flash('error', 'Ảnh không được vựt quá 1.5 Mb!!');
                return redirect()->intended(route('teams.create'));
            }
        }
        $file = $request->file('image');
        $image = $file->hashName();
        $data = [
            'image' => $image,
            'title' => $request->title,
            'slug' => $request->slug,
            'position' => $request->position,
            'description' => $request->description
        ];
        $insert = $this->teamsRepository->save($data);
        if($insert){
            $file->move('storage/app/teams', $file->hashName());
            Session::flash('success', 'Thêm mới thành viên thành công!');
            return redirect()->intended('admin/about');
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
        $detail = $this->teamsRepository->find($id);
        return view('admin.teams.edit', ['detail' => $detail]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamsRequest $request, $id)
    {
        $detail = $this->teamsRepository->find($id);
        if($request->image){
            $size = $request->image->getSize();
            if($size > 1572864){
                Session::flash('error', 'Ảnh không được vựt quá 1.5 Mb!!');
                return redirect()->intended(route('teams.edit', ['team' => $id]));
            }
        }
        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'position' => $request->position,
            'description' => $request->description
        ];
        if($request->image){
            $file = $request->file('image');
            $image = $file->hashName();
            $data['image'] = $image;
        };
        $update = $this->teamsRepository->update($id, $data);
        if($update){
            if($request->image){
                Storage::delete('teams/'. $detail['image']);
            }
            Session::flash('success', 'Cập nhật thành cồng!');
            return redirect()->intended('admin/about');
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
}
