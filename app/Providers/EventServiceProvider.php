<?php namespace LANMS\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'LANMS\Events\Event' => [
			'LANMS\Listeners\EventListener',
		],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @return void
	 */
	public function boot()
	{
		parent::boot();

		//
	}

}
