<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-add-new-role">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title mb-2">Roles</h3>
                    <p class="text-muted">Set role permissions</p>
                </div>
                <!-- Add role form -->
                <form id="addRoleForm" class="row g-3" method="post" >
                    @method('PUT')
                    @csrf
                    <div class="col-12 mb-4">
                        <label class="required" for="title">{{ trans('cruds.role.fields.title') }}</label>
                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                               name="title" id="title" value="{{ old('title', '') }}" required>
                        @if($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <h5>Role Permissions</h5>
                        <!-- Permission table -->
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>

                                @foreach($permissionParsed as $permissionParsedIndex => $permissionParsedItem)
                                    <tr>
                                        <td class="text-nowrap fw-semibold">{{$permissionParsedIndex}}</td>
                                        <td>
                                            <div class="d-flex">
                                                @foreach($permissionParsedItem as $item)
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="permissions[]"
                                                               id="permission_id_{{ $item['key'] }}" value="{{ $item['key'] }}"/>
                                                        <label class="form-check-label" for="permission_id_{{ $item['key'] }}">
                                                            {{ $item['value'] }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Permission table -->
                    </div>
                    <div class="col-12 text-center mt-4">
                        <a id="submitAddRole" class="btn btn-primary me-sm-3 text-white      me-1">Submit</a>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
                <!--/ Add role form -->
            </div>
        </div>
    </div>
</div>
<!--/ Add Role Modal -->
