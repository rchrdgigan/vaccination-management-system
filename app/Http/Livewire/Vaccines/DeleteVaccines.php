<?php

namespace App\Http\Livewire\Vaccines;

use Livewire\Component;
use App\Models\Vaccine;

class DeleteVaccines extends Component
{
    protected $listeners = ['delete'];

    public $vaccine;

    public function deleteConfirm(){
        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $this->vaccine->id,
            'message' => 'Are you sure?'
        ]);
    }

    public function delete($id){
        $vaccine = Vaccine::find($id);
        $vaccine->delete();
        return redirect()->to('/vaccines');
    }
    public function render()
    {
        return view('livewire.vaccines.delete-vaccines');
    }
}
