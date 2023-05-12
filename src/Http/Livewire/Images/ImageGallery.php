<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Images;

use Livewire\Component;

class ImageGallery extends Component
{
    public $galleryId = 'gallery';
    public $models = [];
    public $idColumn = 'id';
    public $titleColumn = null;
    public $columns = [];

    public $items;
    public $selectedItem;

    public function mount()
    {
        if(is_array($this->items) && count($this->items) > 0 && array_key_exists('name', $this->items[0]) && array_key_exists('items', $this->items[0])){
            //Do not load any models, if items are set manually
            return;
        }

        $fetchedColumns = [$this->idColumn];
        if($this->titleColumn != null){
            array_push($fetchedColumns, $this->titleColumn);
        }

        $this->items = [];
        foreach($this->models as $modelName => $model)
        {
            $this->items[$modelName] = [
                'name' => $modelName,
                'items' => []
            ];

            foreach($model::all(array_merge($fetchedColumns, $this->columns)) as $singleModel){
                $this->items[$modelName]["items"][$singleModel->{$this->idColumn}] = [
                    'id' => $singleModel->{$this->idColumn},
                ];
                if(!is_null($this->titleColumn)){
                    $this->items[$modelName]["items"][$singleModel->{$this->idColumn}]["title"] = $singleModel->{$this->titleColumn};
                }
                $this->items[$modelName]["items"][$singleModel->{$this->idColumn}]["columns"] = [];
                foreach($this->columns as $column)
                {
                    $this->items[$modelName]["items"][$singleModel->{$this->idColumn}]["columns"][$column] =
                    [
                        'path' => $singleModel->{$column},
                        'url' => $singleModel->getImageUrl($column)
                    ];
                }
            }
        }
    }

    public function render()
    {
        return view('livecontrols::livewire.images.image-gallery');
    }

    public function select(string $path)
    {
        $this->selectedItem = $path;
        $this->emit('imageSelectedForGallery'.$this->galleryId, $path);
    }
}