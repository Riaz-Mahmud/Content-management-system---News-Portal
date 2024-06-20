<?php

namespace App\View\Components\Frontend\Menu;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Crypt;

class MenuList extends Component
{
    protected $menuItems;
    protected $menu;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($code){
        $this->menuItems = [];
        if($code){
            $this->menu = $code;
            $data['rose'] = $this->menu->items()
                ->select('id', 'menu_id', 'parent_id', 'label', 'href', 'icon', 'order')
                ->where('is_deleted', 0)->where('parent_id', '=', null)->orderBy('order', 'ASC')->get();
            $data['haveParent'] = $this->menu->items()
                ->select('id', 'menu_id', 'parent_id', 'label', 'href', 'icon', 'order')
                ->where('is_deleted', 0)->where('parent_id', '!=', 0)->orderBy('id', 'ASC')->get();
            $data['rose'] = $this->menuItemParentChild($data['rose'], $data['haveParent']);
            $this->menuItems = $data['rose'];
        }
    }

    function menuItemParentChild($rose, $parent){

        foreach($rose as $value){
            $value['hashId'] = Crypt::encrypt($value->id);
            foreach($parent as $value2){
                if($value->id == $value2->parent_id){
                    $value['haveChild'] = true;
                    $value['child'] = $this->menu->items()
                        ->select('id', 'menu_id', 'parent_id', 'label', 'href', 'icon', 'order')
                        ->where('is_deleted', 0)->where('parent_id', $value->id)->orderBy('order', 'ASC')->get();

                    if(count($value['child']) > 0){
                        $this->menuItemParentChild($value['child'], $parent);
                    }

                }
            }
        }
        return $rose;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.menu.menu-list')->with('menuItems',$this->menuItems);
    }
}

