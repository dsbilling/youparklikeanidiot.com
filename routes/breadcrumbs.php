<?php

// Home
Breadcrumbs::for('home', function ($trail) {
     $trail->push('Home', route('home'));
});

Breadcrumbs::for('login', function ($trail) {
    $trail->parent('home');
    $trail->push('Logg Inn', route('login'));
});

Breadcrumbs::for('register', function ($trail) {
    $trail->parent('home');
    $trail->push('Registrer', route('register'));
});

// Error 404
Breadcrumbs::for('errors.404', function ($trail) {
    $trail->parent('home');
    $trail->push('Page Not Found');
});

Breadcrumbs::macro('pageTitle', function () {
    $title = ($breadcrumb = Breadcrumbs::current()) ? "{$breadcrumb->title} – " : '';

    if (($page = (int) request('page')) > 1) {
        $title .= "$page – ";
    }

    return $title . config('app.name');
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
        $trail->push('Rediger', route($route."edit", $id));
    });
});

Breadcrumbs::resource('parking', 'Parkeringer');