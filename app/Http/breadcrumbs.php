<?php

//Pagrindinis
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Pagrindinis', '/');
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

