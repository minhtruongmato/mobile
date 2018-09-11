<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\OrmProductRepository;

class ProductApiController extends Controller
{
    protected $ormProductRepository;

    public function __construct(
    	OrmProductRepository $ormProductRepository
    ){
    	$this->ormProductRepository = $ormProductRepository;
    }

    public function getNewProducts()
    {
    	$result = $this->ormProductRepository->paginate(4);
    	return response()->json($result, 200);
    }

    public function getTopProducts()
    {
        $result = $this->ormProductRepository->get_products_by_discounted(8);
        return response()->json($result, 200);
    }

    public function getDiscountProducts()
    {
        $result = $this->ormProductRepository->get_products_by_discounted(4);
        return response()->json($result, 200);
    }

    public function getRelatedProducts($slug)
    {
        $detail = $this->ormProductRepository->get_by_slug($slug);
        $result = $this->ormProductRepository->get_by_type_id($detail->type_id, 3);
        return response()->json($result, 200);
    }

    public function getDetailProduct($slug)
    {
        $result = $this->ormProductRepository->get_by_slug($slug);
        $result['template'] = json_encode(array_combine(json_decode($result->template_title), json_decode($result->template_content)));
        return response()->json($result, 200);
    }
}
