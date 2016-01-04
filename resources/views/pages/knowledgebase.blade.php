@extends('layouts.master')

@section('description')
<meta name="description" content="Maze žinynas ir dažniausiai užduodami klausimai." />
@stop

@section('breadcrumbs')
	{!! Breadcrumbs::render('page.knowledgebase') !!}
@stop

@section('title')
Žinynas | @parent
@stop

@section('content')
<div class="row">
	<div class="col-md-4" id="kb-nav">
		<ul id="nav" class="kb-nav nav hidden-xs hidden-sm">
			<li>
				<a href="#duk">D.U.K</a>
				<ul class="nav">
					<li>
						<a href="#pamirsau-slaptazodi">Pamiršau slaptažodį, ką daryti?</a>
					</li>
					<li>
						<a href="#el-pasto-atnaujinimai">Aš nebenoriu gauti pranešimų į el. paštą, ką daryti?</a>
					</li>
					<li>
						<a href="#populiariausios-temos">Kaip yra atrenkamos "populiariausios" temos?</a>
					</li>
					<li>
						<a href="#slapyvardzio-keitimas">Aš noriu pasikeisti savo slapyvardį, kaip tai būtų galima padaryti?</a>
					</li>
					<li>
						<a href="#registracijos-informacija">Ar būtina registruojantis vesti teisingą informacija?</a>
					</li>
					<li>
						<a href="#pasiekimai">Ar yra numatomi, kokie nors apdovanojimai už pranešimus ateityje?</a>
					</li>
					<li>
						<a href="#nepopuliari-tema">Kodėl mano sukurta tema nesulaukia jokių pranešimų?</a>
					</li>
					<li>
						<a href="#karmos-pranesimai">Ar galiu peržiūrėti visus pranešimus, kuriems esu pridėjęs ar nuėmęs karmos?</a>
					</li>
					<li>
						<a href="#anglu-kalba">Aš nemoku anglų kalbos/sunkiai suprantu, ar atsiras kokių nors sunkumų naudotis forumu dėl to?</a>
					</li>
					<li>
						<a href="#prenumerata">Užsiprenumeravau narį, kas dabar?</a>
					</li>
					<li>
						<a href="#pavogtas-vartotojas">Kažkas pavogė mano vartotoją, ką daryti?</a>
					</li>
					<li>
						<a href="#paminejimai">Kaip padaryti nario vardą nuoroda į jo profilį?</a>
					</li>
					<li>
						<a href="#kontaktai">Ar galiu susisiekti kaip nors su maze komandos nariais ne per forumą?</a>
					</li>
					<li>
						<a href="#rangai">Ar yra daugiau rangų nei tik narys, moderatorius ir administratorius?</a>
					</li>
					<li>
						<a href="#kodas">Kas buvo naudojama kuriant maze puslapį?</a>
					</li>
					<li>
						<a href="#atranka-i-komanda">Norėčiau tapti moderatoriumi, ar tai yra įmanoma?</a>
					</li>
					<li>
						<a href="#pasalintas-turinys">Administratorius/moderatorius ištrynė mano temą/komentarą/būsenos atnaujinimą, kodėl?</a>
					</li>
					<li>
						<a href="#atsakymas">Neradote savo klausimui atsakymo?</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#karma">Karma</a>
			</li>
			<li>
				<a href="#temos">Temos</a>
				<ul class="nav">
					<li>
						<a href="#temu-tipai">Temų tipai</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#markdown">Markdown</a>
				<ul class="nav">
					<li>
						<a href="#kas-yra-markdown">Kas yra markdown?</a>
					</li>
					<li>
						<a href="#markdown-pagalba">Markdown pagalba</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#klaidos">Klaidos</a>
				<ul class="nav">
					<li>
						<a href="#testavimas">Testavimas</a>
					</li>
					<li>
						<a href="#pranesti-apie-klaida">Pranešti apie klaidą</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
	<div class="col-md-8">
		<section id="duk">
			<h2>D.U.K. <small>Dažniausiai Užduodami Klausimai</small></h2>
			<h3 id="pamirsau-slaptazodi">Pamiršau slaptažodį, ką daryti?</h3>
			<p>Slaptažodį gali pasikeisti apsilankęs <a href="">čia</a>. Norint pakeisti slaptažodį, vartotojas privalo būti registruotas su <strong>veikiančiu</strong> el. pašto adresu.</p>
			<h3 id="el-pasto-atnaujinimai">Aš nebenoriu gauti pranešimų į el. paštą, ką daryti?</h3>
			<p>Norint atsisakyti el. laiškų siuntimo tau reikia prisijungti į savo vartotoją ir apsilankyti <a href="{{ route('user.settings') }}">nustatymų</a> skiltyje. Apačioje bus galima pasirinkti kokius laiškus gauti nori ir kokių laiškų siuntimą geriau išjungti.</p>
			<h3 id="parasas">Kodėl negaliu užsidėti parašo?</h3>
			<p>Maze platforma nepalaiko parašų. Vietoje parašų, leidžiame lankytojams užsirašyti trumpą "apie mane" tekstą <a href="{{ route('user.profile') }}">profilyje</a>.</p>
			<h3 id="neigiama-karma">Aš dedu visiems neigiamą karmą, kokios gali būti pasekmės?</h3>
			<p>Už neigiamos karmos dalinimą baudžiama tik tais atvejais, kai neigiama karma dalinama kenkėjiškai. Gavus nusiskundimą, pati administracija nusprendžia ar karma buvo dalinama kenkėjiškai ar ne.</p>
			<h3 id="populiariausios-temos">Kaip yra atrenkamos "populiariausios" temos?</h3>
			<p>Populiariausioms temoms atrinkti naudojame algoritmą. Kiekviena tema turi savą "svorį". Kuo "svoris" didesnis, tuo tema "svarbesnė" ir bus aukščiau sąrašuose. Tam tikri veiksniai temai svorio prideda (balsavimas, komentavimas ir pan.), o kai kurie atima.</p>
			<p>Algoritmas toli gražu nėra tobulas ir ilgainiui bus tobulinamas.</p>
			<h3 id="slapyvardzio-keitimas">Aš noriu pasikeisti savo slapyvardį, kaip tai būtų galima padaryti?</h3>
			<p>Kol kas slapyvardžio pasikeisti negalima.</p>
			<p>Po maze 2.0 išleidimo (2016 Sausio 6 d.), visi nariai gavo vieną nemokamą slapyvardžio pasikeitimą. Nauji nariai užsiregistravę po 2016 Sausio 6 d. slapyvardžio pasikeisti negali.</p>
			<h3 id="registracijos-informacija">Ar būtina registruojantis vesti teisingą informacija?</h3>
			<p>Maze - ne policijos nuovada. Informacijos teisingumo netikriname. Tačiau norint pasikeisti slaptažodį, veikiantis el. pašto adresas yra privalomas.</p>
			<h3 id="pasiekimai">Ar yra numatomi, kokie nors apdovanojimai už pranešimus ateityje?</h3>
			<p>Planuojame ateityje daryti "pasiekimus" ar panašaus pobūdžio "apdovanojimus" už aktyvų dalyvavimą diskusijose ir kokybiško turinio kūrimą. Tačiau tai tik planai, ir tikriausiai atsiras dar negreit.</p>
			<h3 id="spamas">Ar būsiu baudžiamas jei užtvindysiu forumą pranešimais, atsižvelgiant į tai,kad pranešimai atitiks maze etiketą?</h3>
			<p>Priklauso nuo pranešimų turinio.</p>
			<h3 id="cenzura">Ar yra įdiegti kokie nors pranešimų cenzūravimai?</h3>
			<p>Ne. Kalbos stengiamės nevaržyti, tačiau nenustebkite, jei būsite "apdovanotas" neigiama karma už pranešimą ar temą su daug keiksmų.</p>
			<h3 id="nepopuliari-tema">Kodėl mano sukurta tema nesulaukia jokių pranešimų?</h3>
			<p>Gali būti, kad geimeriai tiesiog miega, arba yra užsiėmę kitais reikalais. Taip pat, gali būti, jog tavo temos turinys yra nelabai aktualus bendruomenei, dėl to dauguma tiesiog temoje neapsilanko.</p>
			<h3 id="karmos-pranesimai">Ar galiu peržiūrėti visus pranešimus, kuriems esu pridėjęs ar nuėmęs karmos?</h3>
			<p>Ne, bet administracija gali ;)</p>
			<h3 id="anglu-kalba">Aš nemoku anglų kalbos/sunkiai suprantu, ar atsiras kokių nors sunkumų naudotis forumu dėl to?</h3>
			<p>Maze platforma yra kurta lietuvaičių ir lietuvaičiams. Jeigu kyla nesklandumų ar neaiškumų, visada galite susisiekti su administracija.</p>
			<h3 id="prenumerata">Užsiprenumeravau narį, kas dabar?</h3>
			<p>Užprenumeruoto nario veiklą (būsenos atnaujinimus, komentarus, pranešimus ir k.t.) bus galima stebėti savo <a href="{{ route('user.profile') }}">profilyje</a>, sekamųjų skiltyje.</p>
			<h3 id="pavogtas-vartotojas">Kažkas pavogė mano vartotoją, ką daryti?</h3>
			<p>Susisiekti su administracija.</p>
			<h3 id="paminejimai">Kaip padaryti nario vardą nuoroda į jo profilį?</h3>
			<p>Tai vadinama paminėjimu. Tereikia prieš nario vardą padėti @ simbolį. Pvz: <a href="{{ route('user.show', 'edvinas') }}">@Edvinas</a>.</p>
			<h3 id="n18-avataras">Užsidėjau nuotrauką, kuri yra n18, kas bus dabar?</h3>
			<p>Nuotrauka bus pašalinta. Piktybiškas nuotraukos keitaliojimas atgal gali baigtis nario ar net lankytojo blokavimu.</p>
			<h3 id="kontaktai">Ar galiu susisiekti kaip nors su maze komandos nariais ne per forumą?</h3>
			<p>El. paštu. Tap pat didžioji dauguma komandos narių naudoja Skype, Steam ir Twitch.</p>
			<h3 id="mobili-versija">Ar bus kokių nors nesklandumų jei prisijungsiu prie forumo per mobilų telefoną?</h3>
			<p>Netūrėtų, bet jei bus - prašome pranešti administracijai.</p>
			<h3 id="rangai">Ar yra daugiau rangų nei tik narys, moderatorius ir administratorius?</h3>
			<p>Taip.</p>
			<h3 id="kodas">Kas buvo naudojama kuriant maze puslapį?</h3>
			<p>Maze yra atviro kodo. Visada galima pažiūrėti <a href="https://github.com/SkepticalHippo/maze">čia</a>.</p>
			<h3 id="atranka-i-komanda">Norėčiau tapti moderatoriumi, ar tai yra įmanoma?</h3>
			<p>Atrankos į komandą visada yra skelbiamos viešai. Kartais, žmonės, prisidedantys prie bendruomenės gerinimo ir rodantys norą tapti bendruoenės prižiūrėtojais, gali būti paskirti moderatoriais be atrankos.</p>
			<h3 id="pasalintas-turinys">Administratorius/moderatorius ištrynė mano temą/komentarą/būsenos atnaujinimą, kodėl?</h3>
			<p>Nes jis pažeidė taisykles arba tiesiog buvo netinkamo turinio ar netinkamoje vietoje.</p>
			<h3 id="atsakymas">Neradote savo klausimui atsakymo?</h3>
			<p><a href="{{ route('page.contact') }}">Parašykite mums</a>.</p>
		</section>
		<section id="karma">
			<h2>Karma</h2>
			<p>Karma yra naudojama nustatyti narių kuriamo turinio kokybę. Kiekvienas narys turi savo individualų karmos skaitiklį. Nors karma platformoje naudojama ne per daugiausiai, patiems nariams ji parodo kokį turinį bendruomenė mėgsta, o kokio nelabai.</p>
		</section>
		<section id="temos">
			<h2>Temos</h2>
			<h3 id="temu-tipai">Temų tipai</h3>
			<p>Kiekviena tema gali turėti savo atskirą tipą. Šiuo metu maze platforma palaiko tris pagrindinius temų tipus:</p>
			<ol>
				<li>Diskusija - naudojama pažymėti paprastas diskusijas.</li>
				<li>Klausimas - naudojama pažymėti temoms, kurios yra klausiamo pobūdžio. Temos autorius gali išrinkti tinkamą atsakymą ir jį pažymėti.</li>
				<li>Pranešimas - naudojama tik maze komandos. Skirta informuoti bendruomenės narius.</li>
			</ol>
		</section>
        <section id="markdown">
        	<h2>Markdown</h2>
        	<h3 id="kas-yra-markdown">Kas yra markdown?</h3>
        	<p>Maze.lt naudoja šiek tiek netradicinį teksto formatavimo būdą - Markdown. Tai pakankamai galinga teksto formatavimo sintaksė (panašiai kaip bbcode). Žemiau esantys pavyzdžiai padės jums greitai perprasti Markdown.</p>
        	<h3 id="markdown-pagalba">Markdown pagalba</h3>
			<h4>Teksto Pastorinimas (Bold)</h4>
			<p>Kodas: <code>**Tavo tekstas**</code></p>
			{!! markdown('Rezultatas: **tavo tekstas**') !!}

			<h4>Teksto Pakreipimas (Italic)</h4>
			<p>Kodas: <code>~Tavo tekstas.~</code></p>
			<p>Kodas: <code>_Tavo tekstas._</code></p>
			{!! markdown('Rezultatas: _Tavo tekstas._') !!}

			<h4>Paveikslėlių ir nuotraukų įdėjimas (Image)</h4>
			<p><i>Tekstas tarp [] simbolių bus matomas su pelyte užvedus ant paveikslėlio. Jis gali būti tuščias.</i></p>
			<p>Kodas: <code>![alt tekstas](http://i.imgur.com/fOmgQkv.png)</code></p>
			{!! markdown('Rezultatas: ![alt tekstas](http://i.imgur.com/fOmgQkv.png)') !!}

			<h4>Kodo Blokas (Code)</h4>
			<p>Yra keletas skirtingų būdų formatuoti tekstą su markdown'u. Jeigu nori kodą suformatuoti viduryje teksto, naudok ` kabutes: <code>`var example = true`</code>.
			Taip pat kodo pradžioje ir pabaigoje gali parašyti ``` arba ~~~:
			<pre><code>~~~
if (isAwesome){
  return true
}
~~~</code></pre>
			</p>
{!! markdown('Yra keletas skirtingų būdų formatuoti tekstą su markdown\'u. Jeigu nori kodą suformatuoti viduryje teksto, naudok ` kabutes: `var example = true`. Jeigu turi ilgesnį kodą gali jį atitraukti su 4 tarpais:

    if (isAwesome){
      return true
    }

Taip pat kodo pradžioje ir pabaigoje gali parašyti ``` arba ~~~, tuomet nereikės kodo atitraukinėti:

```
if (isAwesome){
  return true
}
```') !!}
			<h4>Antraštės (Headings)</h4>
			<p>Kodas: <pre><code>#Čia yra h1 tag'as
##Čia yra h2 tag'as
######Čia yra h6 tag'as</code></pre></p>
			{!! markdown(e('Rezultatas: 
# Čia yra h1 tag\'as
## Čia yra h2 tag\'as
###### Čia yra h6 tag\'as')) !!}
			
			<h4>Citavimas (Blockquotes)</h4>
			<h4>Sąrašai (Lists)</h4>
			<h4>Nuorodos (Links)</h4>
        </section>
        <section id="klaidos">
			<h2>Klaidos</h2>
			<h3 id="testavimas">Testavimas</h3>
			<p>Testavimams yra naudojama uždara portalo versija. Norintys prisijungti prie uždaro testavimo gali susisiekti su administracija.</p>
			<p>Norintys testuoti lokalioje aplinkoje gali parsisųsti maze kodą iš <a href="https://github.com/SkepticalHippo/maze">maze GitHub paskyros</a>.</p>
			<h3 id="pranesti-apie-klaida">Pranešti apie klaidą</h3>
			<p>Visi pranešimai apie klaidas yra priimami <a href="https://github.com/SkepticalHippo/maze/issues">maze GitHub paskyroje</a>.</p>
		</section>
	</div>
</div>
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop

@section('scripts')
<script type="text/javascript">
	$('#nav').affix({
	    offset: {     
	      top: $('.kb-nav').offset().top,
	      bottom: $('footer').outerHeight(true)
	    }
	});
	$(document).ready(function(){
	    $("body").scrollspy({
			target: "#kb-nav"
		}) 
	});
</script>
@stop