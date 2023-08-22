<div class="modal fade text-start" id="reasonModal" tabindex="-1" aria-labelledby="reasonModal" aria-hidden="true"
    data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="reasonModal">Please write Reasons</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="reason-form pt-0" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="next" value="false">

                    <div class="mb-3">
                        <label class="required" for="process_notes">Reason</label>
                        <textarea class="form-control" name="process_notes" id="process_notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
