<?php

namespace Helvetiapps\LiveControls\Http\Livewire\BbEditor;

use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;

class BbEditor extends Component
{
    use WithFileUploads;

    public $areaid; //The ID of the control, if not set it will be called bbeditor
    public $hiddeninputid; //The ID of the hidden input in case it is set
    public $savebuttontext; //The text on the savebutton

    public $content;
    public $oldcontent;

    public $redir; //If set it will redirect to this route after saving
    public $redirparams; //if set it will redirect with those params
    public $savefunction; //Set this to a function which accepts a string for $content and saves it to a model or such and it should return a boolean

    public $blurEvent; //Set this to an event to emit when the blur event is called by the editor. Useful inside livewire components
    
    public $successMessage;
    public $exceptionMessage;

    public $savebutton;

    public $theme; //The link to the theme
    public $dateFormat; //The dateformat

    public $locale; //The locale to be used

    public $uploadEnabled = false; //If false, upload will be hidden
    public $uploadDisk; //The disk for the upload
    public $uploadFolder; //The folder for the upload

    public $uploadedImage; //The image uploaded with the uploading form

    public function mount()
    {
        if(is_null($this->areaid))
        {
            $this->areaid = "bbeditor";
        }
        if(is_null($this->hiddeninputid))
        {
            $this->hiddeninputid = "hiddeninput";
        }
        if(is_null($this->successMessage))
        {
            $this->successMessage = __('Document saved!');
        }
        if(is_null($this->exceptionMessage))
        {
            $this->exceptionMessage = __('Document couldnt be saved!');
        }
        if(is_null($this->redirparams) || !is_array($this->redirparams))
        {
            $this->redirparams = [];
        }
        if(is_null($this->savebuttontext))
        {
            $this->savebuttontext = __('Save');
        }
        if(is_null($this->savebutton))
        {
            $this->savebutton = true;
        }
        if(is_null($this->theme)){
            $this->theme = "https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css";
        }
        if(is_null($this->dateFormat)){
            $this->dateFormat = "day/month/year";
        }
    }

    public function render()
    {
        return view('livecontrols::livewire.bbeditor.bbeditor');
    }


    public function uploadImage()
    {
        if(is_null($this->uploadDisk)){
            throw new Exception('You need to set the upload disk!');
        }
        if(is_null($this->uploadFolder)){
            throw new Exception('YOu need to set the upload folder!');
        }
        $this->validate([
            'uploadedImage' => 'image|max:2048'
        ]);
        $imgUrl = $this->uploadedImage->store($this->uploadFolder, $this->uploadDisk);
        $this->emit('imageUploaded'.$this->areaid, $imgUrl);
    }

    public function save()
    {
        if($this->content == null || $this->content == "")
        {
            return;
        }
        if($this->savefunction == null || $this->savefunction == "")
        {
            throw new Exception("No savefunction set!");
        }

        $sv = $this->savefunction;


        if(!is_callable($sv)){
            throw new Exception("The savefunction \"".$sv."\" is not callable!");
        }

        //Sanitize the content before continue
        $clean_content = strip_tags($this->content);

        $clean_content = str_replace('"', '\"', $clean_content);
        if($sv($clean_content))
        {
            $this->dispatchBrowserEvent('showToast', ['success', $this->successMessage]);
            if(!is_null($this->redir)){
                return redirect()->route($this->redir, $this->redirparams)->with('success', $this->successMessage);
            }
            return;
        }
        $this->dispatchBrowserEvent('showToast', ['exception', $this->exceptionMessage]);
    }
}
