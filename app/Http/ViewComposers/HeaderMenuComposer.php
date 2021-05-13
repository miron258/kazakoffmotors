<?php

namespace App\Http\ViewComposers;

use App\Models\Admin\Menu;
use Illuminate\View\View;
use App\Models\API\Admin\MenuItems;

class HeaderMenuComposer
{

    protected $headerMenu;

    function __construct()
    {
        $this->menuItems = new MenuItems;
        //Главное навигационное меню вверху сайта

        //Главное навигационное меню вверху сайта
        $lefToptmenu = buildMenu($this->menuItems->getMenuItems(1), 'leftTopMenu', Menu::where('id', 1)->first()->class);
        $rightToptmenu = buildMenu($this->menuItems->getMenuItems(2), 'rightTopMenu', Menu::where('id', 2)->first()->class);
        $shopMenu = buildMenu($this->menuItems->getMenuItems(7), 'shopMenu', Menu::where('id', 7)->first()->class);
        $shopMenuCatalog = buildMenu($this->menuItems->getMenuItems(6), 'shopMenuCatalog', Menu::where('id', 6)->first()->class);

        ///Header Top Menu
        $this->headerMenu = array(
            'mainmenujson' => array('mmenu'=> buildMenu($this->menuItems->getMenuItems(5), 'mobileMenu', Menu::where('id', 5)->first()->class, true, false)),
            'leftMenu' => $lefToptmenu,
            'rightMenu' => $rightToptmenu,
            'shopMenu' => $shopMenu,
            'shopMenuCatalog' => $shopMenuCatalog
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
        $view->with('menu', $this->headerMenu);
    }
}
