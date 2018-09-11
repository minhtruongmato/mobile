<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\OrmOrderRepository;
use App\Repositories\Db\DbOrderRepository;
use App\Repositories\Db\DbCustomerRepository;
use Illuminate\Support\Facades\DB;

class OrderApiController extends Controller
{
    protected $ormOrderRepository;
    protected $dbOrderRepository;
    protected $dbCustomerRepository;
    function __construct(
    	OrmOrderRepository $ormOrderRepository,
    	DbOrderRepository $dbOrderRepository,
    	DbCustomerRepository $dbCustomerRepository
    )
    {
    	$this->ormOrderRepository = $ormOrderRepository;
    	$this->dbOrderRepository = $dbOrderRepository;
    	$this->dbCustomerRepository = $dbCustomerRepository;
    }

    public function create(Request $request)
    {
    	$customer = $request->customer;
    	$code = substr(str_shuffle(MD5(microtime())), 0, 9);
        $customer['unique_code'] = strtoupper($code);
        unset($customer['id']);
    	$order = [];

    	$result = false;
    	DB::beginTransaction();
    	try{
    		$cutomerInsertId = $this->dbCustomerRepository->getInsertId($customer);
    		foreach ($request->order as $key => $value) {
	    		$order[$key]['customer_id'] = $cutomerInsertId;
	    		$order[$key]['product_id'] = $value['product']['id'];
	    		$order[$key]['product_title'] = $value['product']['title'];
	    		$order[$key]['product_quantity'] = $value['quantity'];
	    		$order[$key]['product_total_cost'] = $value['quantity'] * ($value['product']['price'] - $value['product']['discount']);
	    	}
    		if($cutomerInsertId){
		    	$result = $this->dbOrderRepository->save($order);
	    	}
	    	DB::commit();
    	}catch(\Exception $e){
    		DB::rollback();
    	}

    	if($result){
            return response()->json(['orderCode' => $code, 'message' => 'success'], 200);
        }else{
            return response()->json(['orderCode' => null, 'message' => 'fail'], 404);
        }
    }
}