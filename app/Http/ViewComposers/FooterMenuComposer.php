<?php

namespace App\Http\ViewComposers;

use App\Models\Admin\Menu;
use Illuminate\View\View;
use App\Models\API\Admin\MenuItems;

class FooterMenuComposer
{

    protected $footerMenu;

    function __construct()
    {
        $this->menuItems = new MenuItems;
        $footerMenu1 = buildMenu($this->menuItems->getMenuItems(3), 'footerMenu1', Menu::where('id', 3)->first()->class);
        $footerMenu2 = buildMenu($this->menuItems->getMenuItems(4), 'footerMenu2', Menu::where('id', 4)->first()->class);
        $this->footerMenu = array(
            'footermenu1' => $footerMenu1,
            'footermenu2' => $footerMenu2,
        );


    }

    /** Привязывание динамических данных к конкретной ячейке в объекте View
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('menu', $this->footerMenu);
    }
}
