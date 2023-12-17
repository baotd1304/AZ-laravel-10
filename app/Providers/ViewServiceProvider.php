<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer([
            'admin.*',
            'components.*',
        ], 'App\View\Composers\PublishComposer');
        View::composer([
            'admin.postCatalogue.store',
            'components.*',
        ], 'App\View\Composers\PostCatalogueComposer');
    }
}
