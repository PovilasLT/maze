<div id='confirm-answer-{{ $reply->id }}' class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Temos atsakymas</h4>
      </div>
      <div class="modal-body">
        <p>Pasirinkus šį pranešimą kaip temos atsakymą, tema bus automatiškai užrakinta.</p>
        <p>Atsakymą rinkitės tik tada, jeigu visi jūsų klausimai buvo atsakyti.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
        <a href="{{ route('reply.answer', $reply->id) }}" class='btn btn-success'>Pasirinkti atsakymą</a>
      </div>
    </div>
  </div>
</div>