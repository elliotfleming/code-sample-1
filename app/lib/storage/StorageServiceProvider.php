<?php namespace EveryEquity\Storage;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider
{
    // Automatically triggered by Laravel
    public function register()
    {
        $this->app->bind(
            'EveryEquity\Storage\User\UserRepositoryInterface',
            'EveryEquity\Storage\User\EloquentUserRepository'
        );
    }
}
