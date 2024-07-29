<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Informasi: @yield('modal_title')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @yield('modal_content')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#infoModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modalType = button.data('modal-type');
        var modalTitle = button.data('modal-title');
        var modalContent = button.data('modal-content');

        var modal = $(this);
        modal.find('.modal-title').text(modalTitle);
        modal.find('.modal-body').text(modalContent);
    });
</script>

