<?php


namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the application repositories
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('setTrashed', function (bool $trashed = false) {
            return $trashed ? $this->withTrashed() : $this;
        });
        Builder::macro('setSearch', function (string $search = null) {
            return !is_null($search) ? $this->search($search) :  $this;
        });
        Builder::macro('setFilters', function (array $filters = []) {
            array_walk($filters, function ($value, $scope)  {
                return $this->{str_replace("_", "", ucwords($scope, " /_"))}($value);
            });
            return $this;
        });
    }
}
