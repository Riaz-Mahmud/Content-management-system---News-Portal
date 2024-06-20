<?php

namespace App\View\Components\Head;

use Illuminate\View\Component;

class TinymceConfig extends Component
{
    protected $type;
    protected $folderId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $folder)
    {
        $this->type = $type;
        $this->folderId = $folder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data = array();
        $data['type'] = $this->type;
        $data['folderId'] = $this->folderId;


        return view('components.head.tinymce-config')->with('data', $data);
    }
}
