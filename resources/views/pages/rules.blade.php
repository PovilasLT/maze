@extends('layouts.master')

@section('description')
<meta name="description" content="Maze žaidimų bendruomenės taisyklės." />
@stop

@section('breadcrumbs')
	{!! Breadcrumbs::render('page.rules') !!}
@stop

@section('title')
Etiketas | @parent
@stop

@section('content')
<h1>Maze Etiketas</h1>
<p>Maze etiketas yra bendrų taisyklių sąrašas, kurių privalo laikytis kiekvienas narys.</p>
<ol>
<li><b>Nešiukšlinti</b>
	<ul>
		<li>Kurti temas tik tinkamose kategorijose</li>
		  <ul>
			  <li><i>Jeigu netinka nei viena kategorija, nekurti temos.</i></li>
			  <li><i>Jeigu netyčia sukūrei temą blogoje kategorijoje, paprašyti moderatorių ar administratorių ją perkelti.</i></li>
		  </ul>
		<li>Kurti pranešimus atitinkančius diskusijos temą.</li>
		<li>Nereklamuoti.</li>
	</ul>
</li>

<li>
<b>Neprašyti balsų ir jais nemanipuliuoti</b>		
	<ul>
		<li>Nepirkti balsų</li>
		<li>Nesiūlyti ir nereikalauti balsų</li>
	</ul>

</li>
<li><b>Neskelbti asmeninės informacijos</b></li>

<li><b>Neskelbti pornografinio, warez, brukalų ar bet kokio kito turinio neatitinkančio Lietuvos Respublikos įstatymų.</b></li>
	
<li><b>Neskelbti jokio kopijuoto ar plagijuoto turinio be originalaus autoriaus sutikimo, nenurodant šaltinio ar nenurodant originalaus kodo, dizaino ar idėjos autoriaus.</b></li>

<li><b>Nelaužyti svetainės ir nedaryti nieko kas trikdytų jos veikimą ar neatitiktų normalaus naudojimosi ja</b></li>

<li><b>Laikytis etiketo</b>
	<ul>
		<li>Neįžeidinėti forumo narių</li>
		<li>Nešmeižti forumo narių</li>
	</ul>
</li>
<li>
    <b>Neskelbti jokios informacijos apie MultiPlayer žaidimų "cheats" ir kitas kenkėjiškas programas, kurios vienaip ar kitaip gadintų žaidimo kokybę.</b>
</li>
<li>
	<b>Draudžiama iškelti temą į sąrašo viršų naudojant įvairius bereikšmius pranešimus kaip "Up", "Bump" bei kitus.</b>
</li>
</ol>
<p>Šalia šitų taisyklių yra tikimasi, kad diskusijose vadovausitės sveiku protu, būsite atsakingi ir elgsitės moraliai.</p>
<p><small>Maze administracija pasilieka teisę užblokuoti narį be jokio įspėjimo ar priežasties.</small></p>
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop