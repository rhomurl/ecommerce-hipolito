
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Receipt Invoice</title>
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
                        <div class="invoice-logo"><img width="250" src="https://hipolito-hardware.herokuapp.com/images/logo.png" alt="Invoice logo"></div>
                    </div>
                    <!-- col-lg-6 end here -->
                    <div class="col-lg-6">
                        <!-- col-lg-6 start here -->
                        <div class="invoice-from">
                            <ul class="list-unstyled text-right">
                                <li>Hipolito's Hardware and Construction Supply</li>
                                <li>060-A District 1C, Marawoy</li>
                                <li>Lipa City, Batangas 4217</li>
                            </ul>
                        </div>
                    </div>
                    <!-- col-lg-6 end here -->
                    <div class="col-lg-12">
                        <!-- col-lg-12 start here -->
                        <div class="invoice-details mt25">
                            <div class="well">
                                <ul class="list-unstyled mb0">
                                    <li><strong>Invoice</strong> #{{ $prod->transaction->order_id }}</li>
                                    <li><strong>Invoice Date:</strong> {{ $transDate }}</li>
                                    {{--<li><strong>Due Date:</strong> Thursday, December 1th, 2015</li>--}}
                                    <li><strong>Payment Method:</strong> 
                                        @if($prod->transaction->mode == 'paypal')
                                            PayPal
                                        @elseif($prod->transaction->mode == 'cod') 
                                            Cash on Delivery
                                        @endif
                                    </li>
                                    <li><strong>Status:</strong> <span class="label label-{{ $prod->transaction->mode == 'paypal' || $prod->status == 'delivered' ? 'success' : 'danger' }}">
                                        
                                        @if($prod->transaction->mode == 'paypal' && $prod->status != 'cancelled')
                                            PAID
                                        @elseif($prod->transaction->mode == 'cod' && $prod->status == 'delivered')
                                            PAID
                                        @else
                                            UNPAID
                                        @endif
                                    
                                    </span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="invoice-to mt25">
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
                        </div>
                        <div class="invoice-items">
                            <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="per70 text-center">Description</th>
                                            <th class="per5 text-center">Qty</th>
                                            <th class="per12 text-center">Unit price</th>
                                            <th class="per12 text-center">Total price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($prod->orderProduct as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-center">{{ number_format($item->price, 2) }} PHP</td>
                                            <td class="text-center">{{ number_format($item->price * $item->quantity, 2) }} PHP</td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">Sub Total:</th>
                                            <th class="text-center">{{ number_format($subtotal, 2) }} PHP</th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Shipping Fee:</th>
                                            <th class="text-center">00.00 PHP</th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Tax:</th>
                                            <th class="text-center">00.00 PHP</th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Total:</th>
                                            <th class="text-center">{{ number_format($total, 2) }} PHP</th>
                                        </tr>
                                    </tfoot>
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
    background:#eee;    
}
</style>

<script type="text/javascript">

</script>
</body>
</html>