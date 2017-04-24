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

Breadcrumbs::register('sesi.estrutura',function($breadcrumbs,$page){
    $breadcrumbs->parent('sesi.page');
    $breadcrumbs->push($page->title,'');
});

