{{--<div class="col-lg-6 col-xl col-md-5 col-sm-12 flex-grow-1">
    <form wire:submit.prevent="search" class="search-header">
        @csrf
        <div class="input-group">
            <input wire:model="query" type="text" class="form-control" placeholder="Search products">
        </div>
     <!-- search-wrap .end// -->
</div> <!-- col.// -->
<div class="col col-lg col-md flex-grow-0">
    <button class="btn btn-block btn-primary" type="submit"> Search </button>
    </form>
</div>
--}}

<form wire:submit.prevent="search" class="search-header">
    @csrf
    <div class="input-group w-100">
        <input wire:model="query" type="text" class="form-control" placeholder="Search products">
        
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">
            <i class="fa fa-search"></i> Search
          </button>
        </div>
    </div>
</form> <!-- search-wrap .end// -->