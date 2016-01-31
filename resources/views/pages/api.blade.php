@extends('layouts.master')

@section('description')
<meta name="description" content="Maze žaidimų bendruomenės API" />
@stop


@section('breadcrumbs')
	{!! Breadcrumbs::render('page.rules') !!}
@stop


@section('title')
API | @parent
@stop

@section('content')
<h1>Maze API</h1>
<h3>Turinys</h3>
<ol>
	<li><a href='#intro'>Įžanga</a></li>
	<li><a href='#vartotojai'>Vartotojų duomenys</a></li>
	<ol>
		<li><a href='#vartotoju-sarasas'>Vartotojų sąrašas</a></li>
		<li><a href='#vartotojas'>Vartotojo informacija</a></li>
	</ol>
	<li><a href='#temos'>Temos</a></li>
	<ol>
		<li><a href='#temu-sarasas'>Temų sąrašas</a></li>
		<li><a href='#temu-sukurimas'>Temos sukūrimas</a></li>
		<li><a href='#tema'>Temos informacija</a></li>
		<li><a href='#temu-atnaujinimas'>Temos redagavimas</a></li>
	</ol>
	<li><a href='#pranesimai'>Pranešimai</a></li>
	<ol>
		<li><a href='#pranesimai-kurimas'>Pranešimo kūrimas</a></li>
		<li><a href='#pranesimai-atnaujinti'>Prnaešimo redagavimas</a></li>
		<li><a href='#pranesimai-reikalavimai'>Pranešimo reikalavimai</a></li>
		<li><a href='#pranesimas'>Pranešimo informacija</a></li>
	</ol>
	<li><a href='#kitos'>Kitos užklausos</a></li>
	<ol>
		<li><a href='#naujausios-temos'>Naujausios temos</a></li>
		<li><a href='#populiariausios-temos'>Naujausios temos</a></li>
	</ol>
</ol>

<section>
	<h2 id='intro'>Įžanga</h2>

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
<hr>
<section>
	<h2 id='vartotojai'>Vartotojų duomenys</h2>

	<section>
		<h3 id='vartotoju-sarasas'>Vartotojų sąrašas</h3>
		<p>
			Ši užklausa grąžina varotojų sąrašą puslapiais po 50 vartotojų viename.
		</p>
		
		<table class='table'>
			<tr>
				<th>Užklausos tipas</th>
				<th>Adresas</th>
			</tr>
			<tr>
				<td>GET</td>
				<td>maze.lt/api/users</td>
			</tr>
		</table>
	
	</section>
	<hr>
	<section>
		<h3 id='vartotojas'>Vartotojo informacija</h3>
		<p>
			Ši užklausa vieno vartotojo informacija. Vartotojo ID turi būti nurodytas užklausos adrese. Neradus vartotojo grąžinama klaida.
		</p>
		
		<table class='table'>
			<tr>
				<th>Užklausos tipas</th>
				<th>Adresas</th>
			</tr>
			<tr>
				<td>GET</td>
				<td>maze.lt/api/users/{id}</td>
			</tr>
		</table>
	</section>
</section>


<section>
	<h2 id='temos'>Temų duomenys</h2>

	<section>
		<h3 id='temu-sarasas'>Temų sąrašas</h3>
		<p>
			Ši užklausa grąžina temų sąrašą suskaidyta į puslapius. Viename puslapyje 20 temų.
		</p>
		
		<table class='table'>
			<tr>
				<th>Užklausos tipas</th>
				<th>Adresas</th>
			</tr>
			<tr>
				<td>GET</td>
				<td>maze.lt/api/topics</td>
			</tr>
		</table>
	
	</section>
	<hr>
	<section>
		<h3 id='temu-sukurimas'>Temos sukūrimas</h3>
		<p>
			Užklausa sukuria naują temą. Esantiems netinkamiems argumentams ji grąžins klaidą. Sėkmingai sukūrus temą grąžinamas persiuntimas į jo turinį.
		</p>
		
		<table class='table'>
			<tr>
				<th>Užklausos tipas</th>
				<th>Adresas</th>
			</tr>
			<tr>
				<td>POST</td>
				<td>maze.lt/api/topics</td>
			</tr>
		</table>
		<p>
			Užklausos parametrai. Privalomi pažymėti žvaigždute.
		</p>
		<table class='table'>
			<tr>
				<th>*body</th>
				<th>*title</th>
				<th>*node_id</th>
				<th>*type</th>
			</tr>
			<tr>
				<td>Temos turinys. Min. 10 simbolių</td>
				<td>Temos pavadinimas. Min. 10 simbolių</td>
				<td>Sub-forumo ID</td>
				<td>Tipas</td>
			</tr>
		</table>
	</section>
	<hr>
	<section>
		<h3 id='tema'>Temos informacija</h3>
		<p>
			Užklausa grąžina visą informaciją apie temą(įskaitant pranešimus, jos autorių, forumą). Nurodžius neegzistuojančios temos ID, grąžins klaidą.
		</p>
		
		<table class='table'>
			<tr>
				<th>Užklausos tipas</th>
				<th>Adresas</th>
			</tr>
			<tr>
				<td>GET</td>
				<td>maze.lt/api/topics/{id}</td>
			</tr>
		</table>
	</section>
	<hr>
	<section>
		<h3 id='temos-atnaujinimas'>Temos redagavimas</h3>
		<p>
			Užklausa leidžia atnaujinti egzistuojančią temą. ID privalo būti nurodytas temos adrese.
		</p>
		
		<table class='table'>
			<tr>
				<th>Užklausos tipas</th>
				<th>Adresas</th>
			</tr>
			<tr>
				<td>PUT/PATCH</td>
				<td>maze.lt/api/topics/{id}</td>
			</tr>
		</table>
		<p>
			Parametrai: žr. <a href='#temu-sukurimas'>temos kūrimas</a>
		</p>
	</section>
</section>

<section>
	<h2 id='pranesimai'>Pranešimai</h2>
	<section>
		<h3 id='pranesimai-kurimas'>Pranešimo kūrimas</h3>
		<p>
			Užklausa sukuria naują temos pranešimą. Nurodžius netinkamą temos ID grąžinama klaida.
		</p>
		
		<table class='table'>
			<tr>
				<th>Užklausos tipas</th>
				<th>Adresas</th>
			</tr>
			<tr>
				<td>POST</td>
				<td>maze.lt/api/replies/store</td>
			</tr>
		</table>
		<p>
			Užklausos parametrai. Privalomi pažymėti žvaigždute.
		</p>
		<table class='table'>
			<tr>
				<th>*body</th>
				<th>*topic_id</th>
			</tr>
			<tr>
				<td>Pranešimo turinys. Min. 10 simbolių</td>
				<td>Temos į kurią rašoma ID</td>
			</tr>
		</table>
	</section>
	<hr>
	<section>
		<h3 id='pranesimai-atnaujinti'>Pranešimo redagavimas</h3>
		<p>
			Užklausa leidžia redaguoti esamą pranešimą. 
		</p>
		
		<table class='table'>
			<tr>
				<th>Užklausos tipas</th>
				<th>Adresas</th>
			</tr>
			<tr>
				<td>POST</td>
				<td>maze.lt/api/replies/{id}/update</td>
			</tr>
		</table>
		<p>
			Vienintelis užklausos parametras yra 'body'.
		</p>
	</section>
	<hr>
	<section>
		<h3 id='pranesimai-reikalavimai'>Pranešimo reikalavimai</h3>
		<p>
			Užklausa grąžina redaguojamų atributų pavadinimus ir reikalavimus
		</p>
		
		<table class='table'>
			<tr>
				<th>Užklausos tipas</th>
				<th>Adresas</th>
			</tr>
			<tr>
				<td>GET</td>
				<td>maze.lt/api/replies/rules</td>
			</tr>
		</table>
	</section>
	<hr>
	<section>
		<h3 id='pranesimas'>Pranešimo informacija</h3>
		<p>
			Užklausa grąžina vieno pranešimo informaciją. Užklausos adrese turi būti nurodytas ID.
		</p>
		
		<table class='table'>
			<tr>
				<th>Užklausos tipas</th>
				<th>Adresas</th>
			</tr>
			<tr>
				<td>GET</td>
				<td>maze.lt/api/replies/{id}</td>
			</tr>
		</table>
	</section>
</section>

<section>
	<h2 id='kitos'>Kitos užklausos</h2>
	<section>
		<h3 id='naujausios-temos'>Naujausios temos</h3>
		<p>
			Užklausa grąžina sąrašą naujausių temų. Sąrašas padalintas į puslapius, viename puslapyje yra 20 temų.
		</p>
		
		<table class='table'>
			<tr>
				<th>Užklausos tipas</th>
				<th>Adresas</th>
			</tr>
			<tr>
				<td>GET</td>
				<td>maze.lt/api/popular</td>
			</tr>
		</table>
	</section>
</section>

<section>
	<h2 id='kitos'>Kitos užklausos</h2>
	<section>
		<h3 id='naujausios-temos'>Naujausios temos</h3>
		<p>
			Užklausa grąžina sąrašą naujausių temų. Sąrašas padalintas į puslapius, viename puslapyje yra 20 temų.
		</p>
		
		<table class='table'>
			<tr>
				<th>Užklausos tipas</th>
				<th>Adresas</th>
			</tr>
			<tr>
				<td>GET</td>
				<td>maze.lt/api/popular</td>
			</tr>
		</table>
	</section>
	<hr>
	<section>
		<h3 id='populiariausios-temos'>Populiariausios temos</h3>
		<p>
			Užklausa grąžina sąrašą populiariausių temų. Sąrašas padalintas į puslapius, viename puslapyje yra 20 temų.
		</p>
		
		<table class='table'>
			<tr>
				<th>Užklausos tipas</th>
				<th>Adresas</th>
			</tr>
			<tr>
				<td>GET</td>
				<td>maze.lt/api/new</td>
			</tr>
		</table>
	</section>
</section>

@stop