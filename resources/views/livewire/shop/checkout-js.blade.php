<script>
paypal.Buttons({
      onCancel: function (data, actions) {
        return fetch('/api/paypal/order/cancel/', {
          method: 'POST',
          body:JSON.stringify({
              user_orderid : '{{ $this->orderidz }}'
              })
          }).then(function(res) {
              return res.json();
          }).then(function(res) {
              if(res.response == 'Cancelled'){
                actions.redirect('{{ route('order.cancel') }}');
              }
          });
    
  },

// Sets up the transaction when a payment button is clicked
createOrder: function(data, actions) {
  return fetch('/api/paypal/order/create/', {
      method: 'POST',
      body:JSON.stringify({
          'total': "{{ $this->grandTotal }}",
          //'user_id' : "{{auth()->user()->id}}",
          //'amount' : $("#paypalAmount").val(),
      })
  }).then(function(res) {
      return res.json();
  }).then(function(orderData) {
      return orderData.id;
  });
},

// Finalize the transaction after payer approval
onApprove: function(data, actions) {
  return fetch('/api/paypal/order/capture/' , {
      method: 'POST',
      body :JSON.stringify({
          paypal_orderid : data.orderID,
          user_orderid : '{{ $this->orderidz }}',
          user_id: "{{ auth()->user()->id }}",
          //payment_gateway_id: $("#payapalId").val(),
          
      })
  }).then(function(res) {
      return res.json();
  }).then(function(orderData) {
      

    //console.log();
    if(orderData.error && orderData.error.details[0].issue == 'INSTRUMENT_DECLINED'){
      return actions.restart();
    }
      // Successful capture! For demo purposes:
      //var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

      //if(errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED'){
        //
        
      //}

      //if(errorDetail){
       // var msg = 'Sorry, your transaction could not be processed.';
       // if(errorDetail.description) msg += '\n\n' + errorDetail.description;
       // if(orderData.debug_id) msg += ' (' + orderData.debug_id + ') ';
        //return console.log(msg);
        //Avoid using alert in production
      

     if(orderData.status === 'COMPLETED'){
        //console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
        //console.log(orderData.payer);
        //console.log(orderData.payer.email_address);
        actions.redirect("{{ route('checkout.success', $this->orderidz) }}");
      }
      // Transaction ID
      //console.log(orderData.purchase_units[0].payments.captures[0].id);
       
      //console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
        
     
      //syccess for demo purposes
    //console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
      //var transaction = orderData.purchase_units[0].payments.captures[0];
      //console.log(transaction);
  });
}

}).render('#paypal-button-container');
</script>