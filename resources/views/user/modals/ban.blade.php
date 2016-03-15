<div id='user-confirm-ban-{{ $user->id }}' class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Vartotojo blokavimas</h4>
      </div>
      <div class="modal-body">
        <p>Vartotojui bus uždrausta egzistuoti.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Atšaukti</button>
        <a href="{{ route('user.disable.user', $user->id) }}" class='btn btn-success'>Blokuoti</a>
      </div>
    </div>
  </div>
</div>