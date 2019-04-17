<?php

namespace App\Http\Controllers;
 
use Session;
use Redirect;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Response;
use DB; 

class RazorpayController extends Controller
{    
    public function pay_with_razorpay()
    {        

    	// dd(['1']);
        return view('pay_with_razorpay');
        // return view('welcome');
    }
 
    public function payment()
    {   
        // dd(1);
        $input   = Input::all();
        // $api     = new Api(config('custom.razor_key'), config('custom.razor_secret'));
        $api     = new Api('rzp_test_shJ9jkSCA3ZLGo','noWG3m415LnypdDqCodoiHAO');
        // $api     = new Api(env('razor_key'),env('razor_secret'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
 
        if(count($input)  && !empty($input['razorpay_payment_id']))
        {
            try
            {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
 				// return 1;
 				// return response()->json($response);
                //dd($response);
                
                /*return response()->json(array(
			        'razorpay_payment_id' => $input['razorpay_payment_id'],
			        'amount' => $payment['amount']),
			        200
			    );*/
 			}
            catch (\Exception $e)
            {
                return  $e->getMessage();
                \Session::put('error',$e->getMessage());
                // return 2;
                return redirect()->back();
            }
 
            // Do something here for store payment details in database...
        }
        
        //\Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
        // return response()->json($response);
        // return 3;
        // return redirect()->back();

        DB::insert('insert into store__transactions (transaction_id,amount) values(?,?)',[$input["razorpay_payment_id"],$payment["amount"]]);
        // DB::insert('insert into store__transactions (transaction_id,amount) values(?,?)',['1','100']);
        
        return response()->json(array(
	        'razorpay_payment_id' => $input['razorpay_payment_id'],
	        'amount' => $payment['amount']),
	        200
	    );
        //return view('pay_with_razorpay');
    }
}
