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
        // បង្កើត Object គំរូមួយដែលមានទាំង value និង link ដើម្បីការពារ Error គ្រប់ទំព័រ (Header, Footer, Dashboard)
        $defaultSetting = (object)['value' => '', 'link' => '#'];

        $viewData = [
            'mainColor' => null,
            'SITE_MENUS' => collect(),
            'PRODUCT_TYPES' => collect(),
            'NEW_ARRIVALS' => collect(),
            'HOT_SALES' => collect(),
            'HEADER_LOGOS' => $defaultSetting,
            'SITE_PHONENUMBER' => $defaultSetting,
            'SITE_MAIL' => $defaultSetting,
            'SITE_NAMES' => (object)['value' => 'UNC Computer', 'link' => '#'],
            'SITE_ICONS' => $defaultSetting,
            'SITE_LINK_CHAT' => $defaultSetting,
            'SITE_LINK_TELEGRAM' => $defaultSetting,
            'GET_LOCATION' => $defaultSetting,
            'GET_EMAIL' => $defaultSetting,
            'GET_NUMBER_FOOTER' => $defaultSetting,
            'SITE_TEXTFOOTER' => $defaultSetting,
            'GET_FOLLOW_US' => collect(),
            'GET_IMAGE_PAYMENT' => collect(),
            'GET_EASYLINKS' => collect(),
            'GET_ABOUT_US' => collect(),
        ];

        if (! $this->app->runningInConsole()) {
            try {
                $cacheDuration = 5;
                $cacheRemember = function ($key, $duration, $callback) {
                    return Cache::remember($key, $duration, $callback);
                };

                $viewData['PRODUCT_TYPES'] = $cacheRemember('key_product_types', $cacheDuration, function() {
                    return ProductType::where('status', '1')->get();
                });

                $viewData['SITE_MENUS'] = $cacheRemember('key_site_menus', $cacheDuration, function() {
                    return SiteMenu::where('status', '1')->where('isActiveMenu', '1')->get();
                });

                $viewData['NEW_ARRIVALS'] = $cacheRemember('key_new_arrivals', $cacheDuration, function() {
                    return Products::select('products.id', 'products.product_name', 'products.thumbnail', 'products.original_price', 'products.price_after_discount', 'products.details')
                        ->join('new_arrival_hot_sales', 'new_arrival_hot_sales.product_id', '=', 'products.id')
                        ->where('products.status', '1')
                        ->where('new_arrival_hot_sales.type', 'newArrival')
                        ->orderBy('new_arrival_hot_sales.id', 'desc')
                        ->get();
                });

                $viewData['HOT_SALES'] = $cacheRemember('key_hot_sales', $cacheDuration, function() {
                    return Products::select('products.id', 'products.product_name', 'products.thumbnail', 'products.original_price', 'products.price_after_discount', 'products.details')
                        ->join('new_arrival_hot_sales', 'new_arrival_hot_sales.product_id', '=', 'products.id')
                        ->where('products.status', '1')
                        ->where('new_arrival_hot_sales.type', 'hotSale')
                        ->orderBy('new_arrival_hot_sales.id', 'desc')
                        ->get();
                });

                // ការពារការគាំងពេល DB អត់ទាន់មានទិន្នន័យ
                $viewData['SITE_ICONS'] = Settings::where('key', 'site.icon')->first() ?? $defaultSetting;
                $viewData['SITE_NAMES'] = Settings::where('key', 'site.sitename')->first() ?? (object)['value' => 'UNC Computer', 'link' => '#'];

                $viewData['GET_EASYLINKS'] = $cacheRemember('key_easylinks', $cacheDuration, function() {
                    return EasyLink::select('site_menu.name as site_name', 'easy_links.menu_id', 'easy_links.route')
                        ->join('site_menu', 'site_menu.id', '=', 'easy_links.menu_id')
                        ->get();
                });

                $viewData['GET_ABOUT_US'] = $cacheRemember('key_aboutus', $cacheDuration, function() {
                    return SiteMenu::where('isActiveMenu', '0')->where('status', '1')->get();
                });

                $settings = $cacheRemember('key_settings', $cacheDuration, function() {
                    return Settings::select('key', 'value', 'link')->get();
                });

                $viewData['mainColor'] = optional($settings->firstWhere('key', 'site.color'))->value;
                
                // បញ្ចូល $defaultSetting ដែលមានទាំង value និង link 
                $viewData['HEADER_LOGOS'] = $settings->firstWhere('key', 'site.logo.front') ?? $defaultSetting;
                $viewData['SITE_PHONENUMBER'] = $settings->firstWhere('key', 'site.phonenumber') ?? $defaultSetting;
                $viewData['SITE_MAIL'] = $settings->firstWhere('key', 'site.mail') ?? $defaultSetting;
                $viewData['SITE_LINK_CHAT'] = $settings->firstWhere('key', 'site.chat') ?? $defaultSetting;
                $viewData['SITE_LINK_TELEGRAM'] = $settings->firstWhere('key', 'site.telegram') ?? $defaultSetting;
                $viewData['GET_LOCATION'] = $settings->firstWhere('key', 'site.location') ?? $defaultSetting;
                $viewData['GET_EMAIL'] = $settings->firstWhere('key', 'site.email') ?? $defaultSetting;
                $viewData['GET_NUMBER_FOOTER'] = $settings->firstWhere('key', 'site.numberphone') ?? $defaultSetting;
                $viewData['SITE_TEXTFOOTER'] = $settings->firstWhere('key', 'site.textfooter') ?? $defaultSetting;
                
                $viewData['GET_FOLLOW_US'] = $settings->where('key', 'site.follow_us') ?? collect();
                $viewData['GET_IMAGE_PAYMENT'] = $settings->where('key', 'site.payment_image') ?? collect();

            } catch (\Exception $e) {
                // រំលង Error
            }
        }

        View::share($viewData);
    }
}