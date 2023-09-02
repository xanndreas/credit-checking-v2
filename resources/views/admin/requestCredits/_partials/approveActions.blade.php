@if($requestApprovals)

    @cannot($approveGate)
        <span
            class="badge {{$requestApprovals ? ($requestApprovals->process_status_id > 2 ? 'bg-label-success' : 'bg-label-danger') : 'bg-label-warning'}}">
        {{ $requestApprovals ? $requestApprovals->process_status->process_status : ''  }}
    </span>
    @endcannot

    @can($approveGate)
        @if($requestApprovals->process_status_id == 2)
            <button type="button" class="btn btn-danger waves-effect btn-approvals" data-bs-toggle="modal"
                    data-bs-target="#reasonModal">
                <i class="tf-icons ti ti-x"></i>
            </button>

            <button type="button" class="btn btn-success waves-effect btn-approvals" data-bs-toggle="modal"
                    data-bs-target="#reasonApproveModal">
                <i class="tf-icons ti ti-check"></i>
            </button>
        @else
            <span
                class="badge bg-label-warning">  {{ $requestApprovals->process_status->process_status }}
        </span>
        @endif
    @endcan

@endif

