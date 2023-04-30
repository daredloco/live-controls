<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Images;

use Livewire\Component;

class ImageGallery extends Component
{
    public $models = [];
    public $idColumn = 'id';
    public $titleColumn = null;
    public $columns = [];

    public $items = [];

    public function mount()
    {
        foreach($this->models as $modelName => $model)
        {
            $items = $model::all([$this->idColumn, $this->columns]);
            $this->items[$modelName] = [];
            foreach($items as $item)
            {
                $this->items[$modelName][$item->{$this->idColumn}] = [
                    'columns' => []
                ];
                if(is_null($this->titleColumn)){
                    $this->items[$item->{$this->idColumn}]["title"] = $item->{$this->titleColumn};
                }else{
                    $this->items[$item->{$this->idColumn}]["title"] = null;
                }
                foreach($this->columns as $column)
                {
                    $this->items[$item->{$this->idColumn}]["columns"][$column] = $item->{$column};
                }
            }
        }
    }

    public function render()
    {
        return view('livecontrols::livewire.images.image-gallery');
    }
}
