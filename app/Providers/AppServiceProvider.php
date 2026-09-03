<?php

namespace App\Providers;

use A17\Twill\Facades\TwillAppSettings;
use A17\Twill\Facades\TwillNavigation;
use A17\Twill\Services\Settings\SettingsGroup;
use A17\Twill\View\Components\Navigation\NavigationLink;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       // Register Twill Settings
       TwillAppSettings::registerSettingsGroups(
            SettingsGroup::make()->name('seo')->label(trans('twill-metadata::form.titles.fieldset')),
        );

        TwillNavigation::addLink(
            NavigationLink::make()->forModule('menuLinks')->title('Web Menu')
        );
        TwillNavigation::addLink(
            NavigationLink::make()->forModule('pages')
            ->setChildren([
                NavigationLink::make()->forModule('chunkers')->title('Little texts'),
                NavigationLink::make()->forModule('testimonials')->title('Testimonials'),
            // NavigationLink::make()->forModule('contactForms')->title('Contact Form'),
            ]),
        );

        TwillNavigation::addLink(
            NavigationLink::make()->forModule('servicesPackages')->title('Services Packages')
        );
        TwillNavigation::addLink(
            NavigationLink::make()->forModule('contactForms')->title('Contact Form')
        );
        /*TwillNavigation::addLink(
            NavigationLink::make()->forModule('saleActions')->title('Sale actions')
        );
        TwillNavigation::addLink(
            NavigationLink::make()->forModule('locations')
        );*/
        
    }
}
