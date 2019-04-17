<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
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
                            <input type="text" name="username" /><br>
                            <input type="amount" name="amout"/><br>
                            <input type="submit" name="pay" value="Pay">
                            <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key           = "{{ Config::get('custom.razor_key') }}"
                                    data-amount        = "1000"
                                    data-buttontext    = "Pay 10 INR"
                                    data-name          = "LaravelXpert"
                                    data-description   = "Order Value"
                                    data-image         = "yout_logo_url"
                                    data-prefill.name  = "name"
                                    data-prefill.email = "email"
                                    data-theme.color   = "#ff7529">
                            </script>
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>