<?php

//Pagrindinis
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Pagrindinis', '/');
});

//Statiniai puslapiai

Breadcrumbs::register('page.about', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Apie', route('page.about'));
});

Breadcrumbs::register('page.contact', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Susisiekti', route('page.contact'));
});

Breadcrumbs::register('page.knowledgebase', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Žinynas', route('page.knowledgebase'));
});

Breadcrumbs::register('page.rules', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Etiketas', route('page.rules'));
});

Breadcrumbs::register('page.team', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Komanda', route('page.team'));
});

//Skiltis
Breadcrumbs::register('node.show', function($breadcrumbs, $node)
{
    $breadcrumbs->parent('home');
    //Jeigu skiltis turi parent skiltį, parodyti ir ją.
    if($node->parent)
    {
    	$breadcrumbs->push($node->parent->name, route('node.show', $node->parent->slug));
    }
    $breadcrumbs->push($node->name, route('node.show', $node->slug));
});

//Tema
Breadcrumbs::register('topic.show', function($breadcrumbs, $topic)
{
    $breadcrumbs->parent('node.show', $topic->node);
    $breadcrumbs->push($topic->title, route('topic.show', $topic->id));
});

Breadcrumbs::register('topic.edit', function($breadcrumbs, $topic)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Temos redagavimas', route('topic.edit', [$topic->id]));
});

Breadcrumbs::register('topic.create', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Temos Kūrimas', route('topic.create'));
});

//Pranesimas

Breadcrumbs::register('reply.edit', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Pranešimo redagavimas', route('reply.edit'));
});

//Vartotojo routes

// Žinutės

Breadcrumbs::register('user.messages', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Žinutės');
});

//Profilis

Breadcrumbs::register('user.profile', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Profilis');
});

Breadcrumbs::register('user.show', function($breadcrumbs, $user)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(e($user->username), route('user.show', $user->slug));
});

Breadcrumbs::register('user.followers', function($breadcrumbs, $user)
{
    $breadcrumbs->parent('user.show', $user);
    $breadcrumbs->push('Prenumeratoriai', route('user.followers', $user->slug));
});

Breadcrumbs::register('user.settings', function($breadcrumbs, $user)
{
    $breadcrumbs->parent('user.show', $user);
    $breadcrumbs->push('Nustatymai', route('user.settings', $user->slug));
});

//Busenu atnaujinimai

Breadcrumbs::register('status.show', function($breadcrumbs, $status)
{
    $breadcrumbs->parent('user.show', $status->user);
    $breadcrumbs->push('Būsenos Atnaujinimas', route('status.show', $status->id));
});

Breadcrumbs::register('status.edit', function($breadcrumbs, $status)
{
    $breadcrumbs->parent('status.show', $status);
    $breadcrumbs->push('Redaguoti būsenos atnaujinimą', route('status.edit', $status->id));
});

Breadcrumbs::register('status.comment.edit', function($breadcrumbs, $comment)
{
    $breadcrumbs->parent('status.show', $comment->status);
    $breadcrumbs->push('Redaguoti komentarą', route('status.comment.edit', $comment->id));
});

//Paieska

Breadcrumbs::register('search.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Paieška', route('search.index'));
});

Breadcrumbs::register('search.results', function($breadcrumbs)
{
    $breadcrumbs->parent('search.index');
    $breadcrumbs->push('Rezultatai', route('search.results'));
});
