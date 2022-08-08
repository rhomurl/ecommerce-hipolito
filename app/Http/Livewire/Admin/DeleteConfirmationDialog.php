<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Category, Product, Brand, Banner};
use App\Services\ActivityLogService;
use App\Traits\ModelComponentTrait;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use LivewireUI\Modal\ModalComponent;

class DeleteConfirmationDialog extends ModalComponent
{
    use LivewireAlert;
    use ModelComponentTrait;

    public function mount($id, $model){
        $this->id = $id;
        $this->model = $model;

    }

    public function confirmDelete($id, ActivityLogService $activity){ 
    
        if($this->model == 'Category' || $this->model == 'Brand'){
            if($this->model == 'Category'){
                $model = Category::find($id);
                $product_qty = Product::where('category_id', $id)
                ->whereNotNull('quantity')
                ->get();
            }
            else if($this->model == 'Brand'){
                $model = Brand::find($id);
                $product_qty = Product::where('brand_id', $id)
                ->whereNotNull('quantity')
                ->get();
            }

            if(count($product_qty)){
                $this->forceClose()->closeModal();
                $this->errorAlert('This '. $this->model . ' Cannot Be Deleted!');
            }
            else{
                $attributes = $this->getAttribute1($model);
                $activity->createLog($model, "", $attributes, 'Deleted '. $this->model);
                $model->delete();
                $this->forceClose()->closeModal();
                $this->successAlert($this->model . ' Deleted Successfully!');
            } 
        }
        else{
            if($this->model == 'Banner'){
                $model = Banner::find($id);
                $image = $model->image;

                if (Storage::disk('gcs')->exists($image)) {

                    $attributes = Banner::where('id', $id)
                    ->select('id','name')
                    ->get();

                    $activity->createLog($model, "", $attributes, 'Deleted '. $this->model);
                    
                    Storage::disk('gcs')->delete($image);
                }
                Banner::where('id', $id)->delete();  
                $this->forceClose()->closeModal();
                $this->successAlert('Banner Deleted Successfully!');
            }
        }

        
    }

    public function render()
    {
        return view('livewire.admin.delete-confirmation-dialog');
    }
}
