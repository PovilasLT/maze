@extends('layouts.master');

@section('description')
<meta name="description" content="Maze žaidimų bendruomenės API" />
@stop


@section('title')
	API | @parent
@stop


@section('content')
<section>
	<h1 id='intro'>Įžanga</h1>
	<p>
		Maze palengviną bendruomenės programų kūrime pateikdami priėjimą prie duomenų patogiu formatu. 
		Šiuo API gali naudotis bet kas, tačiau pirmiausia reikia susigeneruoti porą kodų. 
		Tai padaryti galite <a href='todo'>čia</a>
	</p>
	<p>
		Šis API leidžia pasiekti įvairius duomenis apie vartotoją, temas, pranešimus bei juos kurti siunčiant ir gaunant HTTP užklausas. 
		Prie visų užklausų(išskyrus žetono gavimo užklausą) reikia pridėti prieigos žetoną(angl. access token). 
		Duomenys grąžinami JSON formatu, kad išvengti įprasto HTML, kurį matote naudojantis naršykle rekomenduojama pridėti antraštę
		<code>
			Accept: application/json
		</code>
	</p>
</section>

<section>
	<h1 id='pradzia'>Nuo ko pradėti</h1>
	<p>
		Norint pradėti naudotis Maze API, pirmiausia reikia užregistruoti savo programą. Sistema jai suteiks atitinkamus duomenis, kurių prireiks norint gauti duomenis iš API. 
		Tai galite padaryti <a href="{{ route('api.app.register') }}">čia.</a>
	</p>
</section>

<section>
	<h1 id='pranesimai'>Mini-pranešimai</h1>
	<p>
		Maze API gali siųsti informaciją apie mini-pranešimus(naują AŽ, paminėjimą temoje ir t.t.). 
		Ši funkcija palaiko Google Cloud Messaging(gcm) skirtą Android programėlėms ir Apple Push Notification Service(apns) skirta iOS įrenginiams. 
		Norint gauti tokius pranešimus, jums reikės įjungti jų gavimą <a href="{{ route('api.app') }} ">programos nustatymuose</a>.
		Tada iš programėlių atsiųsti atitinkamus duomenis apie įrenginį į kurį bus siunčiami pranešimai. Apie tai daugiau skaitykite <a href='todo'>dokumentacijoje</a>.
	</p>
</section>
@stop

@section('sidebar')
	@include('includes.user_sidebar')
@stop