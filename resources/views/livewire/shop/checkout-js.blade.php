<script>
paypal.Buttons({
      onCancel: function (data, actions) {
    actions.redirect('{{ route('paypal.cancel') }}');
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
          orderId : data.orderID,
          orderidz : '{{ $this->orderidz }}'
          //payment_gateway_id: $("#payapalId").val(),
          //user_id: "{{ auth()->user()->id }}",
      })
  }).then(function(res) {
      return res.json();
  }).then(function(orderData) {

      // Successful capture! For demo purposes:
      var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

      if(errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED'){
        return actions.restart();
      }

      if(errorDetail){
        var msg = 'Sorry, your transaction could not be processed.';
        if(errorDetail.description) msg += '\n\n' + errorDetail.description;
        if(orderData.debug_id) msg += ' (' + orderData.debug_id + ') ';
        return alert(msg);
        //Avoid using alert in production
      }

     if(orderData.status === 'COMPLETED'){
        actions.redirect("{{ route('checkout.success', $this->orderidz) }}");
     }
      //syccess for demo purposes
    //console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
      //var transaction = orderData.purchase_units[0].payments.captures[0];
  });
}

}).render('#paypal-button-container');
</script>