<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Order;
use App\Customer; //chap 10

class VerifyController extends Controller
{
	public function verify($token) //chap 10
	{
	    /*$customer = Customer::where('activate_token', $token)->first();
	    if ($customer) {
	        $customer->update([
	            'activate_token' => null,
	            'status' => 1
	        ]);
	        return redirect(route('customer.login'))->with(['success' => 'Verification Successful, Please Login']);
	    }*/
	    //return redirect(route('customer.login'))->with(['error' => 'Invalid Verification Token']);
        return redirect(route('backpack.dashboard'));
	}
}