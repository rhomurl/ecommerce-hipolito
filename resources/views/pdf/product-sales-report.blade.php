
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="ut   f-8">
    <title>Product Sales Report</title>
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
                                <span class="text-center"><b>Product Sales Report {{--( $range )--}}
                                {{--Replace this with readable date ex. july 2020 to aug 2020--}}
                                </b></span>
                                
                            </div>
                        </div>
                        <div class="invoice-items">
                            <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="per15 text-center">Product Name</th>
                                            <th class="per15 text-center">Products Sold</th>
                                            <th class="per15 text-center">Current Stock</th>
                                            <th class="per15 text-center">Product Cost</th>
                                            <th class="per15 text-center">Selling Price</th>
                                            <th class="per15 text-center">Total</th>
                                            <th class="per15 text-center">Profit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order_products as $order_product)
                                        <tr>
                                            <td class="text-center">{{ $order_product->product->name }}</td>
                                            <td class="text-center">{{ $order_product->total_quantity }}</td>
                                            <td class="text-center">{{ $order_product->product->quantity }}</td>
                                            <td class="text-center"> {{ number_format($order_product->product->productInventory->product_cost, 2) }} PHP</td>
                                            <td class="text-center"> {{ number_format($order_product->price, 2) }} PHP</td>
                                            <td class="text-center">  {{ number_format($order_product->total_amount, 2) }} PHP</td>
                                            <td class="text-center"> {{ number_format($order_product->total_amount - ($order_product->product->productInventory->product_cost * $order_product->total_quantity), 2 ) }} PHP </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
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