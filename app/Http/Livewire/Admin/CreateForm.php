<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Field;

class CreateForm extends Component
{
    public $model = ['type' => ''];
    public $option = [];
    public $totalOptions = [];

    protected $rules = [
        'model.label' => 'required',
        'model.name' => 'required',
        'model.type' => 'required'
    ];

    public function AddOptions()
    {
        if(!empty($this->option['key']) && !empty($this->option['value']))
        {
            $this->totalOptions[$this->option['key']] = $this->option['value'];
            $this->reset('option');
        }
    }

    public function deleteOptions($key){
        unset($this->totalOptions[$key]);
    }

    public function submit(){
        $this->model = $this->validate();
        $this->model = $this->model['model'];
        if($this->model['type'] == "select"){
            $this->model['html'] = [
                'type' => $this->model['type'],
                'value' => $this->totalOptions
            ];
        }
        else{
            $this->model['html'] = [
                'type' => $this->model['type'],
            ];
        }
        Field::create($this->model);
        $this->reset('model');
    }

    public function deleteRow($id){
        Field::destroy($id);
    }
    public function render()
    {
        return view('livewire.admin.create-form',[
            'table' => Field::all()
        ]);
    }
}
