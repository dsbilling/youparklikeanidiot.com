<?php

// Home
Breadcrumbs::for('home', function ($trail) {
     $trail->push(__('global.home'), route('home'));
});

Breadcrumbs::for('signin', function ($trail) {
    $trail->parent('home');
    $trail->push(__('auth.signin.title'), route('login'));
});

Breadcrumbs::for('signup', function ($trail) {
    $trail->parent('home');
    $trail->push(__('auth.signup.title'), route('register'));
});

Breadcrumbs::for('password.reset', function ($trail) {
    $trail->parent('home');
    $trail->push(__('auth.password.reset.title'), route('password.email'));
});

Breadcrumbs::for('password.request', function ($trail) {
    $trail->parent('home');
    $trail->push(__('auth.password.reset.title'), route('password.email'));
});

Breadcrumbs::for('user.show', function ($trail, $user) {
    $trail->parent('home');
    $trail->push(__('user.title'));
    $trail->push($user, route('user.show', $user));
});

// Error 404
Breadcrumbs::for('errors.404', function ($trail) {
    $trail->parent('home');
    $trail->push(__('error.404.title'));
});

Breadcrumbs::macro('pageTitle', function () {
    $title = ($breadcrumb = Breadcrumbs::current()) ? "{$breadcrumb->title} – " : '';

    if (($page = (int) request('page')) > 1) {
        $title .= "$page – ";
    }

    return $title . request()->getHttpHost();
});

Breadcrumbs::macro('resource', function ($route, $title) {
    // Home > Name
    Breadcrumbs::for($route.".index", function ($trail) use ($route, $title) {
        $trail->parent('home');
        $trail->push($title, route($route.".index"));
    });

    // Home > Name > New
    Breadcrumbs::for($route.".create", function ($trail) use ($route) {
        $trail->parent($route.".index");
        $trail->push('Opprett', route($route.".create"));
    });

    // Home > Name > Post 123
    Breadcrumbs::for($route.".show", function ($trail, $id) use ($route) {
        $trail->parent($route.".index");
        $trail->push($id, route($route.".show", $id));
    });

    // Home > Name > Post 123 > Edit
    Breadcrumbs::for($route.".edit", function ($trail, $id) use ($route) {
        $trail->parent($route.".show", $id);
        $trail->push('Rediger', route($route.".edit", $id));
    });
});

Breadcrumbs::resource(__('parking.uri'), __('parking.title'));
Breadcrumbs::resource(__('info.uri'), __('info.title'));
Breadcrumbs::resource(__('search.uri'), __('search.title'));
Breadcrumbs::resource(__('licenseplate.uri'), __('licenseplate.title'));
