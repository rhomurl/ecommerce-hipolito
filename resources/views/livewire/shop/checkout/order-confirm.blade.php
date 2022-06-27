<section class="text-gray-600 body-font">
   <div class="row">
     <div class="col-lg-12">
         <article class="card first_card">
             <div class="card-body first_card_body">
                 <div class="mt-4 mx-auto text-center" style="max-width:600px">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-25 w-25" viewBox="0 0 20 20" fill="currentColor">
                     <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                   </svg>
                     <div class="my-3">
                         <h2>Do you still want to continue your order?</h2>
                         <p>
                             If you still want to proceed to your order, click the Yes button below.
                         </p>
                     </div>                     
                 </div>
             </div>
             <div class="text-center mb-5">
               <a wire:click.prevent="paynow({{$order->id}})" href="#" class="btn ml-2 btn-primary">Yes</a>
               <a wire:click.prevent="cancelOrder({{$order->id}})" href="#" class="btn ml-2 btn-danger">No</a>
             </div>
         </article>
     </div>
 </div>
</section>