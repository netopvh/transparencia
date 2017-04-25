<?php

// Home
Breadcrumbs::register('sesi.home', function($breadcrumbs)
{
    $breadcrumbs->push('Transparência', route('sesi.index'));
});

Breadcrumbs::register('sesi.page',function($breadcrumbs,$page){
    $breadcrumbs->parent('sesi.home');
    $breadcrumbs->push($page->title,'');
});

// Home
Breadcrumbs::register('senai.home', function($breadcrumbs)
{
    $breadcrumbs->push('Transparência', route('senai.index'));
});

Breadcrumbs::register('senai.page',function($breadcrumbs,$page){
    $breadcrumbs->parent('senai.home');
    $breadcrumbs->push($page->title,'');
});


