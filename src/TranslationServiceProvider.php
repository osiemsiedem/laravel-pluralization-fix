<?php

declare(strict_types=1);

namespace OsiemSiedem\Translation;

use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->afterResolving('translator', function ($translator) {
            $translator->setSelector(new MessageSelector);
        });
    }
}
