<?php

// Home
Breadcrumbs::register('admin.home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('admin.home'));
});

/*
 * Gestão de Usuários
 */
// Home > Perfis
Breadcrumbs::register('admin.users.index', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Usuários', route('admin.users.index'));
});

Breadcrumbs::register('admin.users.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.users.index');
    $breadcrumbs->push('Novo','');
});

Breadcrumbs::register('admin.users.edit', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.users.index');
    $breadcrumbs->push('Editar','');
});

/*
 * Gestão de Perfis
 */
// Home > Perfis
Breadcrumbs::register('admin.roles.index', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Perfis', route('admin.roles.index'));
});
Breadcrumbs::register('admin.roles.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.roles.index');
    $breadcrumbs->push('Novo','');
});
Breadcrumbs::register('admin.roles.edit', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.roles.index');
    $breadcrumbs->push('Editar','');
});

/*
 * Gestão de Logs
 */
// Home > Perfis
Breadcrumbs::register('admin.logs.index', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Logs', route('admin.logs.index'));
});