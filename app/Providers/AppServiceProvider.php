<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // Added for pagination

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		View::composer(
			['components.right_sidebar'],
			'App\Http\View\Composers\BlogComponentsComposer'
		);
		View::composer(
			['components.admin_right_sidebar', 'components.admin_top_bar'],
			'App\Http\View\Composers\AdminComponentsComposer'
		);

		Paginator::useBootstrap(); // Added for pagination
	}
}
