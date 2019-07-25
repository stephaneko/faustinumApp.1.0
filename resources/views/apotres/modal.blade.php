<div class="modal" id="confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Confirmation de la suppression</h4>
            </div>
            <div class="modal-body">
                <p>voulez-vous vraiment supprimé cette enregistrement?</p>
            </div>
            <div class="modal-footer">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-sm btn-primary" id="delete-btn">Supprimer</button>
                <button class="btn btn-danger" data-dismiss="modal">Non</button>
            </div>
        </div>
    </div>
</div>
