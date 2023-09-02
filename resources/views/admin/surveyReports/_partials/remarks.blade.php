<div class="modal fade text-start" id="remarksUpdateModal" tabindex="-1" aria-labelledby="remarksUpdateModal" aria-hidden="true"
     data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Please write Remarks</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="remarks_update_form" class=" pt-0" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="required" for="remarks">Remarks</label>
                        <textarea class="form-control" name="remarks" id="remarks"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
