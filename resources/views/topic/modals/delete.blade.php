<div id='topic-confirm-delete-{{ $topic->id }}' class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content text-left">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Temos pašalinimas</h4>
      </div>
      <div class="modal-body">
        <p>
        	Ar tikrai norite pašalinti temą?
        </p>
        <p>Primename, kad pašalinus temą jos atkurti nebus įmanoma. </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Atšaukti</button>
        <a href="{{ route('topic.delete', [$topic->slug]) }}" class='btn btn-success'>Patvirtinti</a>
      </div>
    </div>
  </div>
</div>
