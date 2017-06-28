<?php

/**
 *
 *
 * SESI
 *
 */

// Home
Breadcrumbs::register('sesi.home', function($breadcrumbs)
{
    $breadcrumbs->push('Transparência', route('sesi.index'));
});

Breadcrumbs::register('sesi.contabeis',function($breadcrumbs){
    $breadcrumbs->parent('sesi.home');
    $breadcrumbs->push('Demonstrações Contábeis',route('sesi.contabeis'));
});

Breadcrumbs::register('sesi.gratuidade',function($breadcrumbs){
    $breadcrumbs->parent('sesi.home');
    $breadcrumbs->push('Gratuidade',route('sesi.gratuidade'));
});

Breadcrumbs::register('sesi.sac',function($breadcrumbs){
    $breadcrumbs->parent('sesi.home');
    $breadcrumbs->push('SAC',route('sesi.sac'));
});

Breadcrumbs::register('sesi.faq',function($breadcrumbs){
    $breadcrumbs->parent('sesi.home');
    $breadcrumbs->push('Perguntas Frequentes (FAQ)',route('sesi.faq'));
});

Breadcrumbs::register('sesi.ldo',function($breadcrumbs){
    $breadcrumbs->parent('sesi.home');
    $breadcrumbs->push('Lei de Diretrizes Orçamentárias',route('sesi.ldo'));
});

Breadcrumbs::register('sesi.dirigentes',function($breadcrumbs){
    $breadcrumbs->parent('sesi.ldo');
    $breadcrumbs->push('Dirigentes',route('sesi.dirigentes'));
});

Breadcrumbs::register('sesi.estrutura',function($breadcrumbs){
    $breadcrumbs->parent('sesi.ldo');
    $breadcrumbs->push('Estrutura Remuneratória',route('sesi.remunera'));
});

Breadcrumbs::register('sesi.tecnicos',function($breadcrumbs){
    $breadcrumbs->parent('sesi.ldo');
    $breadcrumbs->push('Corpo Técnico',route('sesi.tecnicos'));
});

Breadcrumbs::register('sesi.execucao',function($breadcrumbs){
    $breadcrumbs->parent('sesi.ldo');
    $breadcrumbs->push('Execução Orçamentária',route('sesi.execucao'));
});

Breadcrumbs::register('sesi.page',function($breadcrumbs,$page){
    $breadcrumbs->parent('sesi.home');
    $breadcrumbs->push($page->title,'');
});


/**
 *
 * SENAI
 *
 */


// Home
Breadcrumbs::register('senai.home', function($breadcrumbs)
{
    $breadcrumbs->push('Transparência', route('senai.index'));
});

Breadcrumbs::register('senai.contabeis',function($breadcrumbs){
    $breadcrumbs->parent('senai.home');
    $breadcrumbs->push('Demonstrações Contábeis',route('senai.contabeis'));
});

Breadcrumbs::register('senai.gratuidade',function($breadcrumbs){
    $breadcrumbs->parent('senai.home');
    $breadcrumbs->push('Gratuidade',route('senai.gratuidade'));
});

Breadcrumbs::register('senai.sac',function($breadcrumbs){
    $breadcrumbs->parent('senai.home');
    $breadcrumbs->push('SAC',route('senai.sac'));
});

Breadcrumbs::register('senai.faq',function($breadcrumbs){
    $breadcrumbs->parent('senai.home');
    $breadcrumbs->push('Perguntas Frequentes (FAQ)',route('senai.faq'));
});

Breadcrumbs::register('senai.ldo',function($breadcrumbs){
    $breadcrumbs->parent('senai.home');
    $breadcrumbs->push('Lei de Diretrizes Orçamentárias',route('senai.ldo'));
});

Breadcrumbs::register('senai.dirigentes',function($breadcrumbs){
    $breadcrumbs->parent('senai.ldo');
    $breadcrumbs->push('Dirigentes',route('senai.dirigentes'));
});

Breadcrumbs::register('senai.estrutura',function($breadcrumbs){
    $breadcrumbs->parent('senai.ldo');
    $breadcrumbs->push('Estrutura Remuneratória',route('senai.remunera'));
});

Breadcrumbs::register('senai.tecnicos',function($breadcrumbs){
    $breadcrumbs->parent('senai.ldo');
    $breadcrumbs->push('Corpo Técnico',route('senai.tecnicos'));
});

Breadcrumbs::register('senai.execucao',function($breadcrumbs){
    $breadcrumbs->parent('senai.ldo');
    $breadcrumbs->push('Execução Orçamentária',route('senai.execucao'));
});

Breadcrumbs::register('senai.page',function($breadcrumbs,$page){
    $breadcrumbs->parent('senai.home');
    $breadcrumbs->push($page->title,'');
});


