<?php

namespace App\Helpers;

class Menu
{

    public $menu_items = [];

    public static function make($args = [])
    {
        return new Menu($args);
    }

    // make main menu
    public function addMenu($title = 'no title', $url = '/', $icon = 'bx bx-circle', $subs = [])
    {
        $menu = [
            'title' => $title,
            'url' => $url,
            'icon' => $icon,
            'subs' => $subs
        ];

        array_push($this->menu_items, $menu);

        return $this;
    }

    // make sub menu
    public static function addSubMenu($title = 'no title', $url = '/'): array
    {
        return [
            'title' => $title,
            'url' => $url
        ];
    }

    // make menu label
    public function addLabel($title = 'no title')
    {
        $label = [
            'label' => $title
        ];

        array_push($this->menu_items, $label);

        return $this;
    }


    public function get(): array
    {
        $this->mapMenuItems();
        return $this->menu_items;
    }


    // modify the values according the url
    private function mapMenuItems()
    {
        $this->menu_items = collect($this->menu_items)->map(function ($menu) {

            // map if it is a label
            $menu['is_label'] = isset($menu['label']);

            if (!$menu['is_label']) {
                // map if it is active menu
                $menu['is_active'] = request()->url() == $menu['url'];
                $menu['is_active_exact'] = request()->fullUrl() == $menu['url'];
                if ($menu['subs']) {
                    $menu['subs'] = collect($menu['subs'])->map(function ($subMenu) {
                        $subMenu['is_active'] = request()->url() == $subMenu['url'];
                        $subMenu['is_active_exact'] = request()->fullUrl() == $subMenu['url'];
                        return $subMenu;
                    })->toArray();
                    $menu['is_active'] = boolval(collect($menu['subs'])->where('is_active', true)->count());
                }
            }
            return $menu;
        })->toArray();
    }
}
