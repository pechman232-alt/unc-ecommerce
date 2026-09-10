<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use App\Models\Settings;
use App\Models\ProductType;
use App\Models\Products;
use App\Models\SiteMenu;
use App\Models\EasyLink;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // យើងប្រើ try...catch ដើម្បីការពារកុំឱ្យគាំង (Error 500) 
        // នៅពេលដែល Database ថ្មីមិនទាន់បាន Migrate តារាងបញ្ចូល
        try {
            // ONLY run database queries if we are NOT running in the console/build step
            if (! $this->app->runningInConsole()) {
                
                $cacheDuration = 5;
                $cacheRemember = function ($key, $duration, $callback) {
                    return Cache::remember($key, $duration, $callback);
                };

                // Product Types
                $PRODUCT_TYPES = $cacheRemember('key_product_types', $cacheDuration, function() {
                    return ProductType::where('status', '1')->get();
                });

                // Site Menu
                $SITE_MENUS = $cacheRemember('key_site_menus', $cacheDuration, function() {
                    return SiteMenu::where('status', '1')
                        ->where('isActiveMenu', '1')
                        ->get();
                });

                // New Arrivals
                $NEW_ARRIVALS = $cacheRemember('key_new_arrivals', $cacheDuration, function() {
                    return Products::select('products.id', 'products.product_name', 'products.thumbnail', 'products.original_price', 'products.price_after_discount', 'products.details')
                        ->join('new_arrival_hot_sales', 'new_arrival_hot_sales.product_id', '=', 'products.id')
                        ->where('products.status', '1')
                        ->where('new_arrival_hot_sales.type', 'newArrival')
                        ->orderBy('new_arrival_hot_sales.id', 'desc')
                        ->get();
                });

                // Hot Sales
                $HOT_SALES = $cacheRemember('key_hot_sales', $cacheDuration, function() {
                    return Products::select('products.id', 'products.product_name', 'products.thumbnail', 'products.original_price', 'products.price_after_discount', 'products.details')
                        ->join('new_arrival_hot_sales', 'new_arrival_hot_sales.product_id', '=', 'products.id')
                        ->where('products.status', '1')
                        ->where('new_arrival_hot_sales.type', 'hotSale')
                        ->orderBy('new_arrival_hot_sales.id', 'desc')
                        ->get();
                });

                // Site Icons and Names
                $SITE_ICONS = Settings::where('key', 'site.icon')->first();
                $SITE_NAMES = Settings::where('key', 'site.sitename')->first();

                // EasyLinks
                $GET_EASYLINKS = $cacheRemember('key_easylinks', $cacheDuration, function() {
                    return EasyLink::select('site_menu.name as site_name', 'easy_links.menu_id', 'easy_links.route')
                        ->join('site_menu', 'site_menu.id', '=', 'easy_links.menu_id')
                        ->get();
                });

                // About Us
                $GET_ABOUT_US = $cacheRemember('key_aboutus', $cacheDuration, function() {
                    return SiteMenu::where('isActiveMenu', '0')
                        ->where('status', '1')
                        ->get();
                });

                // Settings
                $settings = $cacheRemember('key_settings', $cacheDuration, function() {
                    return Settings::select('key', 'value', 'link')->get();
                });

                // Share data with views
                View::share([
                    'mainColor' => $settings->firstWhere('key', 'site.color')->value ?? null,
                    'SITE_MENUS' => $SITE_MENUS,
                    'PRODUCT_TYPES' => $PRODUCT_TYPES,
                    'NEW_ARRIVALS' => $NEW_ARRIVALS,
                    'HOT_SALES' => $HOT_SALES,
                    'HEADER_LOGOS' => $settings->firstWhere('key', 'site.logo.front') ?? null,
                    'SITE_PHONENUMBER' => $settings->firstWhere('key', 'site.phonenumber') ?? null,
                    'SITE_MAIL' => $settings->firstWhere('key', 'site.mail') ?? null,
                    'SITE_NAMES' => $SITE_NAMES,
                    'SITE_ICONS' => $SITE_ICONS,
                    'SITE_LINK_CHAT' => $settings->firstWhere('key', 'site.chat') ?? null,
                    'SITE_LINK_TELEGRAM' => $settings->firstWhere('key', 'site.telegram') ?? null,
                    'GET_LOCATION' => $settings->firstWhere('key', 'site.location') ?? null,
                    'GET_EMAIL' => $settings->firstWhere('key', 'site.email') ?? null,
                    'GET_NUMBER_FOOTER' => $settings->firstWhere('key', 'site.numberphone') ?? null,
                    'SITE_TEXTFOOTER' => $settings->firstWhere('key', 'site.textfooter') ?? null,
                    'GET_FOLLOW_US' => $settings->where('key', 'site.follow_us') ?? collect(),
                    'GET_IMAGE_PAYMENT' => $settings->where('key', 'site.payment_image') ?? collect(),
                    'GET_EASYLINKS' => $GET_EASYLINKS,
                    'GET_ABOUT_US' => $GET_ABOUT_US,
                ]);
            }
        } catch (\Exception $e) {
            // ទុកឱ្យទទេ ប្រសិនបើមាន Error (ឧ. អត់មាន Table/Column) កូដនឹងរំលង ដើម្បីឱ្យវេបសាយអាចដើរបាន
        }
    }
}