<?php

namespace SalimHosen\Core\Seeders;

use Illuminate\Database\Seeder;
use SalimHosen\Core\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ["title" => "access_permission"],
            ["title" => "create_permission"],
            ["title" => "edit_permission"],
            ["title" => "delete_permission"],

            ["title" => "access_role"],
            ["title" => "create_role"],
            ["title" => "edit_role"],
            ["title" => "delete_role"],

            ["title" => "access_subrole"],
            ["title" => "create_subrole"],
            ["title" => "edit_subrole"],
            ["title" => "delete_subrole"],

            ["title" => "access_user"],
            ["title" => "create_user"],
            ["title" => "edit_user"],
            ["title" => "delete_user"],

            ["title" => "access_company"],
            ["title" => "create_company"],
            ["title" => "edit_company"],
            ["title" => "delete_company"],

            ["title" => "access_contact"],
            ["title" => "create_contact"],
            ["title" => "edit_contact"],
            ["title" => "delete_contact"],

            ["title" => "access_account"],
            ["title" => "create_account"],
            ["title" => "edit_account"],
            ["title" => "delete_account"],

            ["title" => "access_lead"],
            ["title" => "create_lead"],
            ["title" => "edit_lead"],
            ["title" => "delete_lead"],

            ["title" => "access_lead_source"],
            ["title" => "create_lead_source"],
            ["title" => "edit_lead_source"],
            ["title" => "delete_lead_source"],

            ["title" => "access_lead_stage"],
            ["title" => "create_lead_stage"],
            ["title" => "edit_lead_stage"],
            ["title" => "delete_lead_stage"],

            ["title" => "access_pipeline"],
            ["title" => "create_pipeline"],
            ["title" => "edit_pipeline"],
            ["title" => "delete_pipeline"],

            ["title" => "access_sender"],
            ["title" => "create_sender"],
            ["title" => "edit_sender"],
            ["title" => "delete_sender"],

            ["title" => "access_mailing_list"],
            ["title" => "create_mailing_list"],
            ["title" => "edit_mailing_list"],
            ["title" => "delete_mailing_list"],

            ["title" => "access_subscriber"],
            ["title" => "create_subscriber"],
            ["title" => "edit_subscriber"],
            ["title" => "delete_subscriber"],

            ["title" => "access_template"],
            ["title" => "create_template"],
            ["title" => "edit_template"],
            ["title" => "delete_template"],

            ["title" => "access_campaign"],
            ["title" => "create_campaign"],
            ["title" => "edit_campaign"],
            ["title" => "delete_campaign"],

            ["title" => "access_event"],
            ["title" => "create_event"],
            ["title" => "edit_event"],
            ["title" => "delete_event"],

            ["title" => "access_activity"],
            ["title" => "create_activity"],
            ["title" => "edit_activity"],
            ["title" => "delete_activity"],


			["title" => "access_order"],
            ["title" => "create_order"],
            ["title" => "edit_order"],
            ["title" => "delete_order"],

            ["title" => "access_coupon"],
            ["title" => "create_coupon"],
            ["title" => "edit_coupon"],
            ["title" => "delete_coupon"],

            ["title" => "access_brand"],
            ["title" => "create_brand"],
            ["title" => "edit_brand"],
            ["title" => "delete_brand"],

            ["title" => "access_category"],
            ["title" => "create_category"],
            ["title" => "edit_category"],
            ["title" => "delete_category"],

            ["title" => "access_unit"],
            ["title" => "create_unit"],
            ["title" => "edit_unit"],
            ["title" => "delete_unit"],

            ["title" => "access_product"],
            ["title" => "create_product"],
            ["title" => "edit_product"],
            ["title" => "delete_product"],

            ["title" => "access_wishlist"],
            ["title" => "create_wishlist"],
            ["title" => "edit_wishlist"],
            ["title" => "delete_wishlist"],

            ["title" => "access_support_ticket"],
            ["title" => "create_support_ticket"],
            ["title" => "delete_support_ticket"],
            ["title" => "reply_support_ticket"],

            ["title" => "access_contact_message"],
            ["title" => "delete_contact_message"],
            ["title" => "reply_contact_message"],

            ["title" => "access_payment_method"],
            ["title" => "edit_payment_method"],

            ["title" => "access_zone"],
            ["title" => "create_zone"],
            ["title" => "edit_zone"],
            ["title" => "delete_zone"],

            ["title" => "access_shipping_method"],
            ["title" => "create_shipping_method"],
            ["title" => "edit_shipping_method"],
            ["title" => "delete_shipping_method"],

            ["title" => "access_shipping_class"],
            ["title" => "create_shipping_class"],
            ["title" => "edit_shipping_class"],
            ["title" => "delete_shipping_class"],

            ["title" => "access_menu"],
            ["title" => "create_menu"],
            ["title" => "edit_menu"],
            ["title" => "delete_menu"],

            ["title" => "access_page"],
            ["title" => "create_page"],
            ["title" => "edit_page"],
            ["title" => "delete_page"],

            ["title" => "access_blog_category"],
            ["title" => "create_blog_category"],
            ["title" => "edit_blog_category"],
            ["title" => "delete_blog_category"],

            ["title" => "access_blog_tag"],
            ["title" => "create_blog_tag"],
            ["title" => "edit_blog_tag"],
            ["title" => "delete_blog_tag"],

            ["title" => "access_blog_post"],
            ["title" => "create_blog_post"],
            ["title" => "edit_blog_post"],
            ["title" => "delete_blog_post"],

            ["title" => "access_flash_deal"],
            ["title" => "create_flash_deal"],
            ["title" => "edit_flash_deal"],
            ["title" => "delete_flash_deal"],

            ["title" => "access_customer_query"],
            ["title" => "create_customer_query"],
            ["title" => "reply_customer_query"],
            // ["title" => "delete_customer_query"],

            ["title" => "access_menu"],
            ["title" => "create_menu"],
            ["title" => "edit_menu"],
            ["title" => "delete_menu"],

            ["title" => "access_page"],
            ["title" => "create_page"],
            ["title" => "edit_page"],
            ["title" => "delete_page"],

            ["title" => "access_address"],
            ["title" => "create_address"],
            ["title" => "edit_address"],
            ["title" => "delete_address"],

            ["title" => "access_attribute"],
            ["title" => "create_attribute"],
            ["title" => "edit_attribute"],
            ["title" => "delete_attribute"],


            ["title" => "manage_location"],
            ["title" => "manage_setting"],

            ["title" => "customize_welcome_page"],
        ];

        Permission::insert($permissions);
    }
}
