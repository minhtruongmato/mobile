<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\OrmProductTypeRepository;

class ProductTypeApiController extends Controller
{
    protected $ormProductTypeRepository;

    public function __construct(
    	OrmProductTypeRepository $ormProductTypeRepository
    ){
    	$this->ormProductTypeRepository = $ormProductTypeRepository;
    }

    public function index()
    {
    	$result = $this->ormProductTypeRepository->all();
    	return response()->json($result, 200);
    }
}
