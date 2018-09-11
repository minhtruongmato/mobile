<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DB\DbProductTypeRepository;
use App\Repositories\Eloquents\OrmProductTypeRepository;
use App\Repositories\Eloquents\OrmProductRepository;

class ProductTypeController extends Controller
{
	protected $dbProductTypeRepository;
    protected $ormProductTypeRepository;
    protected $ormProductRepository;
    public function __construct(
        DbProductTypeRepository $dbProductTypeRepository,
        OrmProductTypeRepository $ormProductTypeRepository,
        OrmProductRepository $ormProductRepository
    )
    {
        $this->dbProductTypeRepository = $dbProductTypeRepository;
        $this->ormProductTypeRepository = $ormProductTypeRepository;
        $this->ormProductRepository = $ormProductRepository;
    }

    public function index($slug = '')
    {
    	$productType = $this->ormProductTypeRepository->get_by_slug($slug);
    	$products = $this->ormProductRepository->get_by_type_id($productType['id'], 12);
    	$totalProducts = $this->ormProductRepository->count_all_by_type_id($productType['id']);
    	
    	// echo '<pre>';
    	// dd($products->toArray());die;
    	return view('product-type', ['products' => $products, 'productType' => $productType, 'totalProducts' => $totalProducts]);
    }
}
