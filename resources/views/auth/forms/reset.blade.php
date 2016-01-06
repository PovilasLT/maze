<form action="{{ route('auth.reset.token.post') }}" method="POST" role="form">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group">
        <label for="">El-Pašto Adresas</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
    </div>

    <div class="form-group">
        <label for="">Slaptažodis</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <div class="form-group">
        <label for="">Slaptažodžio Patvirtinimas</label>
        <input type="password" class="form-control" id="password" name="password_confirmation">
    </div>
    

    <button type="submit" class="btn btn-primary">Pakeisti Slaptažodį</button>
</form>