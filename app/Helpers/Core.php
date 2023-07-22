<?php

namespace App\Helpers;

use App\Models\Setting;

class Core
{
    // get all the menu items
    public static function dashboardMenu()
    {
        return Menu::make()
            ->addMenu('Dashboard', route('ap.dashboard'), 'bx bx-home')
            ->addMenu('Products', '', 'bx bx-cart', [
                Menu::addSubMenu('Add New Product', route('ap.products.create')),
                Menu::addSubMenu('View All Products', route('ap.products.index')),
                Menu::addSubMenu('Product Categories', route('ap.products-categories.index')),
                Menu::addSubMenu('Product Brands', route('ap.products-brands.index')),
                Menu::addSubMenu('Product Units', route('ap.products-units.index')),
            ])
            ->addMenu('Orders', '', 'bx bx-box', [
                Menu::addSubMenu('View All Orders', route('ap.orders.index')),
            ])
            ->addMenu('Services', '', 'bx bx-globe', [
                Menu::addSubMenu('Add New Service', route('ap.services.create')),
                Menu::addSubMenu('View All Services', route('ap.services.index')),
                // Menu::addSubMenu('Service Categories', route('ap.services-categories.index')),
                Menu::addSubMenu('Service Requests', route('ap.services-requests.index')),
            ])
            ->addMenu('Blogs', '', 'bx bx-book', [
                Menu::addSubMenu('Add Blog', route('ap.blogs.create')),
                Menu::addSubMenu('All Blogs', route('ap.blogs.index')),
                // Menu::addSubMenu('Blog Tags', route('ap.blogs-tags.index')),
                // Menu::addSubMenu('Blog Categories', route('ap.blogs-categories.index')),
            ])
            ->addLabel('Admin Menus')
            ->addMenu('File Manager', route('ap.file-manager'), 'bx bx-file')
            // ->addMenu('Messages', route('ap.contact-messages.index'), 'bx bx-envelope')
            ->addMenu('Users', '', 'bx bx-user', [
                Menu::addSubMenu('Add User', route('ap.users.create')),
                Menu::addSubMenu('All Users', route('ap.users.index')),
            ])
            // ->addMenu('Access Control', '', 'bx bx-key', [
            //     Menu::addSubMenu('Roles', route('ap.roles.index')),
            //     Menu::addSubMenu('Permissions', route('ap.permissions.index')),
            // ])
            ->addMenu('Settings', '', 'bx bx-cog', [
                Menu::addSubMenu('Website Settings', route('ap.settings.website')),
                Menu::addSubMenu('Social Settings', route('ap.settings.social')),
            ])
            ->get();
    }

    // front header nav menu 
    public static function headerNavMenu()
    {
        $menu = new Menu();
        return $menu
            ->addMenu(__('homepage.Home'), route('web.pages.home'))
            ->addMenu(__('homepage.About_Us'), route('web.pages.about.index'))
            ->addMenu(__('homepage.Services'), route('web.pages.services.index'))
            ->addMenu(__('homepage.Auctions'), route('web.pages.auctions.index'))
            ->addMenu(__('homepage.Exhibitions'), route('web.pages.exhibitions.index'))
            ->addMenu(__('Terms and Conditions'), route('web.pages.terms.index'))
            ->addMenu(__('homepage.Contact'), route('web.pages.contact.index'))
            ->get();
    }


    public static function footerMenuOne()
    {
        $menu = new Menu();
        return $menu
            ->addMenu('About us', route('web.pages.about-us'))
            ->addMenu('Feasibility Study', route('web.pages.feastibility-study'))
            ->addMenu('Marketing Services', route('web.pages.markeing-service'))
            ->addMenu('Investment and Investment', route('web.pages.finance-and-investment'))
            ->addMenu('Legal Business', route('web.pages.legal-business'))
            ->addMenu('Consulting and Studies', route('web.pages.consulting-and-studies'))
            ->addMenu('Terms & Condition', route('web.pages.terms-and-condition'))
            ->addMenu('Contact Us', route('web.pages.contact-us'))
            ->get();
    }

    public static function socialMenu()
    {
        $menu = new Menu();
        return $menu
            ->addMenu('facebook', Core::getSetVal('facebook'), 'fa-brands fa-facebook-f')
            ->addMenu('twitter', Core::getSetVal('twitter'), 'fa-brands fa-twitter')
            ->addMenu('linkedin', Core::getSetVal('linkedin'), 'fa-brands fa-linkedin-in')
            ->addMenu('instagram', Core::getSetVal('instagram'), 'fa-brands fa-instagram')
            ->addMenu('pinterest', Core::getSetVal('pinterest'), 'fa-brands fa-pinterest-p')
            ->get();
    }


    public static function getSetVal($setting)
    {
        return Setting::getSetVal($setting);
    }

    public static function getLogo($type = null)
    {
        switch ($type) {
            case 'white':
                return asset('img/logos/logo-white.png');
            case 'black':
                return asset('img/logos/logo.png');
            case 'jpg':
                return asset('img/logos/logo.jpg');
            default:
                return asset('img/logos/logo.jpg');
        }
    }

    public static function currency($num)
    {
        return "SAR " . number_format($num, 2);
    }
}
