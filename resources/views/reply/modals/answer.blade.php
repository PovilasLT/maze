<div id='confirm-answer-{{ $reply->id }}' class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Temos atsakymo pasirinkimas</h4>
      </div>
      <div class="modal-body">
        <p>Ar tikrai norite pasirinkti šį panešimą kaip atsakymą?</p>
        <p>Pasirinkus šį pranešimą kaip atsakymą, tema bus užrakinta ir negalėsite atlikti papildomų veiksmų. </p>
        <p>Patartina atsakymą pasirinkti tik tada, kai pasirinktas atsakymas tikrai atsakė į jūsų klausimą ir nebeturite kitų klausimų susijusia tema. </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Atšaukti</button>
        <a href="{{ route('reply.answer', $reply->id) }}" class="btn btn-success external-uri">Patvirtinti</a>
      </div>
    </div>
  </div>
</div>
