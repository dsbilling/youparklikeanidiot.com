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

Breadcrumbs::macro('resource', function ($name, $title) {
    // Home > Name
    Breadcrumbs::for($name.".index", function ($trail) use ($name, $title) {
        $trail->parent('home');
        $trail->push($title, route($name.".index"));
    });

    // Home > Name > New
    Breadcrumbs::for($name.".create", function ($trail) use ($name) {
        $trail->parent($name.".index");
        $trail->push('Opprett', route($name.".create"));
    });

    // Home > Name > Post 123
    Breadcrumbs::for($name.".show", function ($trail, $id) use ($name) {
        $trail->parent($name.".index");
        $trail->push($id, route($name.".show", $id));
    });

    // Home > Name > Post 123 > Edit
    Breadcrumbs::for($name.".edit", function ($trail, $id) use ($name) {
        $trail->parent($name.".show", $id);
        $trail->push('Rediger', route($name."edit", $id));
    });
});

Breadcrumbs::resource('parking', 'Parkeringer');