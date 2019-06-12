<?php

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
    // Home > Blog
    Breadcrumbs::for("$name.index", function ($trail) use ($name, $title) {
        $trail->parent('home');
        $trail->push($title, route("$name.index"));
    });

    // Home > Blog > New
    Breadcrumbs::for("$name.create", function ($trail) use ($name) {
        $trail->parent("$name.index");
        $trail->push('Opprett', route("$name.create"));
    });

    // Home > Blog > Post 123
    Breadcrumbs::for("$name.show", function ($trail, $model) use ($name) {
        $trail->parent("$name.index");
        $trail->push($model->id, route("$name.show", $model));
    });

    // Home > Blog > Post 123 > Edit
    Breadcrumbs::for("$name.edit", function ($trail, $model) use ($name) {
        $trail->parent("$name.show", $model);
        $trail->push('Rediger', route("$name.edit", $model));
    });
});

Breadcrumbs::macro('crud', function (string $module, string $parent, string $prefix) {
    // Module Name
    Breadcrumbs::register($prefix . '.index', function ($breadcrumbs) use ($module, $parent, $prefix) {
        $breadcrumbs->parent($parent);
        $breadcrumbs->push($module, route($prefix . '.index'));
    });
    // Module Name > Add
    Breadcrumbs::register($prefix . '.create', function ($breadcrumbs) use ($prefix) {
        $breadcrumbs->parent($prefix . '.index');
        $breadcrumbs->push(__('Add'), route($prefix . '.create'));
    });
    // Module Name > Details
    Breadcrumbs::register($prefix . '.show', function ($breadcrumbs, $id) use ($prefix) {
        $breadcrumbs->parent($prefix . '.index');
        $breadcrumbs->push(__('Details'), route($prefix . '.show', $id));
    });
    // Module Name > Edit
    Breadcrumbs::register($prefix . '.edit', function ($breadcrumbs, $id) use ($prefix) {
        $breadcrumbs->parent($prefix . '.show', $id);
        $breadcrumbs->push(__('Update'), route($prefix . '.edit', $id));
    });
});

Breadcrumbs::resource('blog', 'Blog');
Breadcrumbs::for('c', function () {
    Breadcrumbs::crud('Condo', 'main', 'c');
});
