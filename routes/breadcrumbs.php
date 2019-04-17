<?php

Breadcrumbs::macro('resource', function ($name, $title) {
    // Home > Blog
    Breadcrumbs::for("$name.index", function ($trail) use ($name, $title) {
        $trail->parent('admin.');
        $trail->push($title, route("$name.index"));
    });

    // Home > Blog > New
    Breadcrumbs::for("$name.create", function ($trail) use ($name) {
        $trail->parent("$name.index");
        $trail->push('New', route("$name.create"));
    });

    // Home > Blog > Post 123
    Breadcrumbs::for("$name.show", function ($trail, $model) use ($name) {
        $trail->parent("$name.index");
        $trail->push($model->name ?? $model->id, route("$name.show", $model));
    });

    // Home > Blog > Post 123 > Edit
    Breadcrumbs::for("$name.edit", function ($trail, $model) use ($name) {
        $trail->parent("$name.show", $model);
        $trail->push('Edit', route("$name.edit", $model));
    });
});

/**
 * ==============
 */

// Главная
Breadcrumbs::for('admin.', function ($trail) {
    $trail->push('Главная', route('admin.'));
});

// Главная > Панель управления
Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->parent('admin.');
    $trail->push('Панель управления', route('admin.dashboard'));
});

// Главная > Пользователи
Breadcrumbs::resource('admin.users', 'Пользователи');

// Главная > Страницы
Breadcrumbs::resource('admin.pages', 'Страницы');

// Главная > Типы продуктов
Breadcrumbs::resource('admin.product-types', 'Типы продуктов');

// Главная > Продукты
Breadcrumbs::resource('admin.products', 'Продукты');

// Главная > Формы
Breadcrumbs::resource('admin.forms', 'Формы');

// Главная > Заявки
Breadcrumbs::resource('admin.applications', 'Заявки');

// Главная > Резервные копии
Breadcrumbs::resource('admin.backups', 'Резервные копии');

// Главная > Уведомления
Breadcrumbs::resource('admin.attentions', 'Уведомления');

// Главная > Офисы
Breadcrumbs::resource('admin.offices', 'Офисы');
