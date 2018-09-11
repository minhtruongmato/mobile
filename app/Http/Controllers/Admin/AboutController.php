<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\AboutRepositoryInterface;
use App\Repositories\Contracts\TeamsRepositoryInterface;
use App\Http\Requests\AboutRequest;
use Session;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
	protected $aboutRepository;
    protected $teamsRepository;

	public function __construct(
        AboutRepositoryInterface $aboutRepository,
        TeamsRepositoryInterface $teamsRepository
    )
    {
        $this->aboutRepository = $aboutRepository;
        $this->teamsRepository = $teamsRepository;
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        $teams = $this->teamsRepository->paginate(10);
    	$detailAbout = $this->aboutRepository->paginate(1)->first();
    	return view('admin.about.detail', ['detailAbout' => $detailAbout, 'teams' => $teams]);
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit()
    {
        $detail = $this->aboutRepository->paginate(1)->first();
        return view('admin.about.edit', ['detail' => $detail]);
    }

    public function update(AboutRequest $request, $id)
    {
        $detail = $this->aboutRepository->find($id);
        if($request->image){
            $size = $request->image->getSize();
            if($size > 1572864){
                Session::flash('error', 'Ảnh không được vựt quá 1.5 Mb!!');
                return redirect()->intended(route('about.edit'));
            }
        }
        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'content' => $request->content,
        ];
        if($request->image){
            $data['image'] = $request->file('image')->hashName();
            $request->image->move('storage/app/about', $request->file('image')->hashName());
        };
        $update = $this->aboutRepository->update($id, $data);
        if($update){
            if($request->image){
                Storage::delete('about/'. $detail['image']);
            }
            Session::flash('success', 'Cập nhật thành cồng!');
            return redirect()->intended('admin/about');
        }
    }
}
