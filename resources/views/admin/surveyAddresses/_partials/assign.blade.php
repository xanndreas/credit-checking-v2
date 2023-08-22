<div class="modal fade text-start" id="assignModal" tabindex="-1" aria-labelledby="assignModal" aria-hidden="true"
     data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="assignModal">Approve Address</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="assign-form pt-0" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="request_credit_id" class="request_credit_id">
                    <div class="mb-3">
                        <label class="required" for="surveyor_id">Surveyor</label>
                        <select class="form-control select2 {{ $errors->has('surveyor_id') ? 'is-invalid' : '' }}"
                                name="surveyor_id" id="surveyor_id" required>
                            @foreach($user as $item)
                                <option
                                    value="{{ $item->id }}" {{ old('surveyor_id', '') ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('surveyor_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('surveyor_id') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="required" for="process_notes">Notes</label>
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
