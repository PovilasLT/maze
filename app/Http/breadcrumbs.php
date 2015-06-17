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
    	$breadcrumbs->push($node->parent->name, route('node.show', $node->parent->name));
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
    $breadcrumbs->push('Pranešimo redagavimas', route('topic.show'));
});

//Pranesimas

Breadcrumbs::register('reply.edit', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Pranešimo redagavimas', route('topic.create'));
});

//Vartotojo routes

//Profilis
Breadcrumbs::register('user.show', function($breadcrumbs, $topic)
{
    $breadcrumbs->parent('node', $topic->node);
    $breadcrumbs->push($topic->title, route('topic.show', $topic->id));
});
