<p>Sveikas, {{{ $user }}}!</p>
<p>Tema, kurią tu prenumeruoji, turi naują pranešimą:</p>
<h2>{{ $title }}</h2>
{{ $content }}
<p><a href="{{ route('topic.show', [$slug, $id]) }}">Perskaityti ir atsakyti į temą.</a></p>
<p><b>Dėmesio!</b> Po šio laiško, tema gali turėti ir daugiau naujų pranešimų.</p>
<p>Pagarbiai,<br>
	Maze Administracija</p>
<p><small>Atnaujinimų siuntimą el-paštu galite išjungti savo profilio nustatymuose.</small></p>