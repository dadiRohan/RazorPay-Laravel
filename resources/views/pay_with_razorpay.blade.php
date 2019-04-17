@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            @if($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Error!</strong> {{ $message }}
                </div>
            @endif
            {!! Session::forget('error') !!}
            @if($message = Session::get('success'))
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Success!</strong> {{ $message }}
                </div>
            @endif
            {!! Session::forget('success') !!}
            <div class="panel panel-default">
                <div class="panel-heading">Pay With Razorpay</div>
 
                <div class="panel-body text-center">
                    <form action="{{ url('payment') }}" method="POST" >
                        <!-- Note that the amount is in paise = 50 INR -->
                        <!--amount need to be in paisa-->
                        
                        <!-- 
                            data-key           = "{{ Config::get('custom.razor_key') }}"
                         -->
                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key           = "rzp_test_shJ9jkSCA3ZLGo"
                                data-amount        = "1000"
                                data-buttontext    = "Buy"
                                data-name          = "Razorpay"
                                data-description   = "Order Value"
                                data-prefill.name  = "name"
                                data-prefill.email = "email"
                                data-theme.color   = "#ff7529">
                        </script>
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        <!-- <input type="text" name="razorpay_payment_id" value="1">
                        <input type="submit" name="submit" value="Pay"> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
