<div id='server-confirm-rejection-{{ $server->id }}' class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content text-left">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Serverio atmetimas</h4>
      </div>
      <form method='POST' action="{{ route('server.reject', $server->slug) }}">
      @include('includes.csrf')
        <div class="modal-body">
          <p>
          	Ar tikrai norite atmesti šią temą?
          </p>
        
            
          <input type='hidden' name='server_id' value='{{ $server->id }}'>
          <div class="form-group">
            <label for="reason">Atmetimo priežastis</label>
            <input type='text' class='form-control' name='reason' id='reason' value="{{ old('reason') }}" reqired>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Atgal</button>
          <button type='submit' class='btn btn-success'>Atmesti</button>
        </div>
        </form>
      </div>
  </div>
</div>
