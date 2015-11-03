<h2>Users</h2>
<small>Visų narių sąrašas, kuriame gali rasti sau pašnekovą.</small>

<ul class="confer-user-list confer-online-list">
<h3>Prisijungę</h3>
@if ( ! $users['online']->isEmpty())
	@foreach ($users['online'] as $user)
		<li data-userId="{{ $user->id }}">
			<img class="confer-user-avatar" src="{{ url('/') . config('confer.avatar_dir') . $user->avatar }}">
			<span class="confer-user-name">{{ $user->username }}</span>
		</li>
	@endforeach
@else
	<p>Esi vienintelis prisijungęs žmogus!</p>
@endif
</ul>

<ul class="confer-user-list confer-not-online-list">
<h3>Atsijungę</h3>
@if ( ! $users['offline']->isEmpty())
	@foreach ($users['offline'] as $user)
		<li data-userId="{{ $user->id }}">
			<img class="confer-user-avatar" src="{{ url('/') . config('confer.avatar_dir') . $user->avatar }}">
			<span class="confer-user-name">{{ $user->username }}</span>
		</li>
	@endforeach
@else
	<p>Visi nariai yra prisijungę :o</p>
</ul>
@endif