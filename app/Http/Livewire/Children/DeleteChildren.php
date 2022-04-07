<?php

namespace App\Http\Livewire\Children;

use App\Models\Child;
use Livewire\Component;

class DeleteChildren extends Component
{

    protected $listeners = ['delete'];

    public $child;

    public function deleteConfirm(){
        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $this->child->id,
            'message' => 'Are you sure?'
        ]);
    }

    public function delete($id){
        $child = Child::find($id);
        $child->delete();
        return redirect()->to('/children');
    }
    public function render()
    {
        return view('livewire.children.delete-children');
    }
}
