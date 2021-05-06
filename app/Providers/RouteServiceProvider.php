<?php

namespace DPSEI\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'DPSEI\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $tlds = [
            'io' => 'nb',
            'no' => 'nb',
            'com' => 'en',
        ];
        $host = $this->app->request->getHost();
        $host_split = explode('.', $host);
        $tld = end($host_split);

        if (array_key_exists($tld, $tlds)) {
            $locale = $tlds[$tld];
            App::setLocale($locale);
            Carbon::setLocale($locale);
            Route::resourceVerbs([
                'create' => __('uri.create'),
                'edit' => __('uri.edit'),
            ]);
        }

        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
