<div class="modal fade modal-lg text-start" id="historyModal" tabindex="-1" aria-labelledby="historyModal"
     aria-hidden="true"
     data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="historyModal">Please write Reasons</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="pt-0" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <table class="table table-responsive table-hover">
                        <tr>
                            <th class="fw-bold">Process Status</th>
                            <th class="fw-bold">Process Notes</th>
                            <th class="fw-bold">Attribute</th>
                            <th class="fw-bold">Actor</th>
                            <th class="fw-bold">Date</th>
                            <th class="fw-bold">Time</th>
                        </tr>
                        @foreach($workflowRequestCreditHistory as $item)
                            <tr>
                                <th><span class="badge bg-label-warning">{{ $item->process_status }}</span></th>
                                <th>{{ $item->process_notes }}</th>
                                <th>{{ $item->attribute }}</th>
                                <th>{{ $item->actor->name ?? '' }}</th>
                                <th>{{ \Carbon\Carbon::parse($item->created_at)->format('j F, Y') }}</th>
                                <th>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i:s') }}</th>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
