@cannot($approveGate)
    <span
        class="badge {{$requestApprovals ? ($requestApprovals->process_status_id > 2 ? 'bg-label-success' : 'bg-label-danger') : 'bg-label-warning'}}">
        {{ $requestApprovals ? $requestApprovals->process_status->process_status : ''  }}
    </span>
@endcannot

@can($approveGate)
    @if($requestApprovals->process_status_id == 2)
        <button type="button" class="btn btn-danger waves-effect" data-bs-toggle="modal" data-bs-target="#reasonModal">
            <i class="tf-icons ti ti-x"></i>
        </button>

        <form
            action="{{ route('admin.request-credits.approvals', ['requestCredit' => $requestApprovals->request_credit_id]) }}"
            method="POST" style="display: inline-block;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="next" value="true">

            <a onclick="$(this).parent().submit()">
                <button type="button" class="btn btn-success waves-effect">
                    <i class="tf-icons ti ti-check"></i>
                </button>
            </a>
        </form>
    @else
        <span
            class="badge bg-label-warning">  {{ $requestApprovals->process_status->process_status }}
        </span>
    @endif
@endcan


