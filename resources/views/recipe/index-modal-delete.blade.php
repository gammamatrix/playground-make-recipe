@push("body")
    <div
        class="modal fade"
        id="modal-recipe-delete"
        tabindex="-1"
        aria-labelledby="modal-recipe-delete-label"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal-recipe-delete-label">
                        Confirm Deletion
                    </h1>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">Delete the recipe permanently!</div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>
                    <a
                        id="action-confirm-delete"
                        href="#"
                        class="btn btn-danger"
                    >
                        Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
@endpush

@push("body")
    <script type="application/javascript">
        window.onload = function () {
            $('.confirm-delete').on('click', function (e) {
                e.preventDefault();

                const button_confirm_delete = $('#action-confirm-delete');

                if (button_confirm_delete) {
                    button_confirm_delete.attr('href', $(this).attr('href'));
                }
            });
        };
    </script>
@endpush
