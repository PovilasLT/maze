<div id='topic-confirm-delete-{{ $topic->id }}' class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content text-left">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Temos pašalinimas</h4>
      </div>
      <div class="modal-body">
        <p>
        	Ar tikrai norite ištrint temą?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
        <a href="{{ route('topic.delete', [$topic->id]) }}" class='btn btn-success'>Ištrinti</a>
      </div>
    </div>
  </div>
</div>