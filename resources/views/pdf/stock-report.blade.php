
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Stock Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container bootdey">
<div class="row invoice row-printable">
    <div class="col-md-10">
        <!-- col-lg-12 start here -->
        <div class="panel panel-default plain" id="dash_0">
            <!-- Start .panel -->
            <div class="panel-body p30">
                <div class="row">
                    <!-- Start .row -->
                    <div class="col-lg-6">
                        <!-- col-lg-6 start here -->
                        <div class="invoice-logo"><img width="250" src="https://hipolito-hardware.xyz/images/logo.png" alt="Invoice logo"></div>
                    </div>
                    <!-- col-lg-6 end here -->
                    <div class="col-lg-6">
                        <!-- col-lg-6 start here -->
                        <div class="invoice-from">
                            <ul class="list-unstyled text-left">
                                <li>Hipolito's Hardware and Construction Supply</li>
                                <li>060-A District 1C, Marawoy</li>
                                <li>Lipa City, Batangas 4217</li>
                            </ul>
                        </div>
                    </div>
                    <div class="invoice-from">
                        
                    </div>
                    <!-- col-lg-6 end here -->
                    <div class="col-lg-12">
                        <!-- col-lg-12 start here -->
                        <div class="invoice-details mt25">
                            <div class="well">
                                <span class="text-center"><b>Stock Report ({{ $range }})
                                {{--Replace this with readable date ex. july 2020 to aug 2020--}}
                                </b></span>
                                {{--<ul class="list-unstyled mb0">
                                    <li><strong>Invoice</strong> #{{ $prod->transaction->order_id }}</li>
                                    <li><strong>Invoice Date:</strong> {{ $transDate }}</li>
                                    {{--<li><strong>Due Date:</strong> Thursday, December 1th, 2015</li>
                                    <li><strong>Payment Method:</strong> 
                                        @if($prod->transaction->mode == 'paypal')
                                            PayPal
                                        @elseif($prod->transaction->mode == 'cod') 
                                            Cash on Delivery
                                        @endif
                                    </li>
                                    <li><strong>Status:</strong> 
                                        
                                        @if($prod->transaction->mode == 'paypal' && $prod->status != 'cancelled')
                                            <span class="label label-success">PAID
                                        @elseif($prod->transaction->mode == 'cod' && $prod->status == 'delivered')
                                            <span class="label label-success">PAID
                                        @else
                                            <span class="label label-danger">UNPAID
                                        @endif
                                    
                                    </span></li>
                                </ul>--}}
                            </div>
                        </div>
                        {{--<div class="invoice-to mt25">
                            <ul class="list-unstyled">
                                <li><strong>Invoiced To</strong></li>
                                <li>{{ $address->entry_firstname }} {{ $address->entry_lastname }}</li>
                                @if($address->entry_company)
                                    <li>{{ $address->entry_company }}</li>
                                @endif
                                <li>{{ $address->entry_street_address }}, {{ $address->barangay->name }}</li>
                                <li>{{ $address->barangay->city->name }}, Batangas {{ $address->barangay->city->zip }}</li>
                                <li>{{ $address->entry_phonenumber }}</li>  

                            </ul>
                        </div>--}}
                        <div class="invoice-items">
                            <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="per15 text-center">Product Name</th>
                                            <th class="per15 text-center">Quantity</th>
                                            @if($groupProduct == false)
                                                <th class="per15 text-center">Remarks</th>
                                            @endif
                                            <th class="per15 text-center">Created Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($genOrders as $order)
                                        <tr>
                                            <td class="text-center">{{ $order->product->name }}</td>
                                            <td class="text-center">{{ $order->quantity }}</td>
                                            @if($groupProduct == false)
                                                <td class="text-center">{{ $order->remarks }}</td>
                                            @endif
                                            <td class="text-center"> {{ \Carbon\Carbon::parse($order->created_at)->format('m-d-Y') }}</td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    {{--<tfoot>
                                        <tr>
                                            <th colspan="4" class="text-right">Total:</th>
                                            <th class="text-center"> {{ number_format($genOrders->sum('total'), 2) }} PHP</th>
                                        </tr>
                                    </tfoot>--}}
                                </table>
                            </div>
                        </div>
                        <div class="invoice-footer mt25">
                            <p class="text-center">Generated on {{ $generatedAt }} by {{ Auth::user()->name }}</p>
                        </div>
                    </div>
                    <!-- col-lg-12 end here -->
                </div>
                <!-- End .row -->
            </div>
        </div>
        <!-- End .panel -->
    </div>
    <!-- col-lg-12 end here -->
</div>
</div>

<style type="text/css">
body{
    margin-top:10px;
    /*background:#eee;*/    
}
</style>
</body>
</html>