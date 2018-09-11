<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquents\OrmProductRepository;
use App\Repositories\Eloquents\OrmProductTypeRepository;
use App\Repositories\Eloquents\OrmTemplateRepository;
use Illuminate\Support\Facades\Input;
use Cart;
class ProductController extends Controller
{
	protected $ormProductRepository;
    protected $ormProductTypeRepository;
    protected $ormTemplateRepository;

    public function __construct(
        OrmProductRepository $ormProductRepository,
        OrmProductTypeRepository $ormProductTypeRepository,
        OrmTemplateRepository $ormTemplateRepository
    ){
        $this->ormProductRepository = $ormProductRepository;
        $this->ormProductTypeRepository = $ormProductTypeRepository;
        $this->ormTemplateRepository = $ormTemplateRepository;
    }

    public function index($slug)
    {
        // Cart::destroy();
        // echo '<pre>';
        // print_r(Cart::content());
        // echo Cart::subtotal();die;
    	$detail = $this->ormProductRepository->get_by_slug($slug);
        $relatedProducts = $this->ormProductRepository->get_by_type_id($detail['type_id'], 3);
        $newProducts = $this->ormProductRepository->paginate(5);
    	return view('product', ['detail' => $detail, 'relatedProducts' => $relatedProducts, 'newProducts' => $newProducts]);
    }

    public function addToCart(Request $request)
    {
        $cart = Cart::add($request->id, $request->name, 1, $request->price, ['image' => $request->image, 'slug' => $request->slug]);
        $content = Cart::content();
        $total = Cart::subtotal(0);
        $count = Cart::count();
        return response()->json([
            'content' => $content,
            'total' => $total,
            'count' => $count
        ]);
    }
}
