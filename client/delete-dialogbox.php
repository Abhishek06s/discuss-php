<div class="modal fade" id="deleteModal<?php echo $q_id; ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title">
                    Delete Question
                </h5>

                <button 
                    type="button" 
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                Are you sure you want to delete this question?

                <br><br>

                <strong>
                    This action cannot be undone.
                </strong>

            </div>

            <div class="modal-footer">

                <button 
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Cancel

                </button>

                <a 
                    href="./server/requests.php?delete=<?php echo $q_id; ?>"
                    class="btn btn-danger">

                    Delete

                </a>
            </div>
        </div>
    </div>
</div>