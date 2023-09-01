<?php

namespace App\Http\Controllers\Traits;


use App\Models\RequestCredit;
use App\Models\WorkflowProcess;
use App\Models\WorkflowRequestCredit;
use App\Models\WorkflowRequestCreditHistory;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

trait WorkflowCreditRequestTrait
{
    public function submitActions($next, $userId, $requestCreditId, $notes = null, $attribute = null, $attribute_2 = null): bool
    {
        $workflowRequestCredit = WorkflowRequestCredit::where('request_credit_id', $requestCreditId)->first();
        if (!$workflowRequestCredit && $next) {
            $requestCredit = RequestCredit::with('auto_planner')->where('id', $requestCreditId)->first();
            if ($requestCredit) {
                $workflowProcessId = 1;
                $workflowRequestCredit = WorkflowRequestCredit::create([
                    'request_credit_batch' => $requestCredit->batch_number,
                    'request_credit_id' => $requestCredit->id,
                    'last_change_by_id' => $userId,
                    'process_status_id' => $workflowProcessId
                ]);
            }
        }

        if (!$this->nextProcess($workflowRequestCredit->process_status_id) && $next) {
            return false;
        }

        if (!$this->previousProcess($workflowRequestCredit->process_status_id) && !$next) {
            return false;
        }

        if ($next) {
            abort_if(Gate::denies($workflowRequestCredit->process_status->permissions),
                Response::HTTP_FORBIDDEN, '403 Forbidden');

            $workflowProcessId = $this->nextProcess($workflowRequestCredit->process_status_id)->id;
            $workflowRequestCredit->update([
                'last_change_by_id' => $userId,
                'process_status_id' => $workflowProcessId,
            ]);
        } else {
            abort_if(Gate::denies($workflowRequestCredit->process_status_id->permissions),
                Response::HTTP_FORBIDDEN, '403 Forbidden');

            $workflowProcessId = $this->previousProcess($workflowRequestCredit->process_status_id)->id;
            $workflowRequestCredit->update([
                'last_change_by_id' => $userId,
                'process_status_id' => $workflowProcessId,
            ]);
        }

        $workflowProcess = WorkflowProcess::where('id', $workflowProcessId)->first();
        $workflowRequestCreditHistory = WorkflowRequestCreditHistory::create([
            'workflow_request_credit_id' => $workflowRequestCredit->id,
            'actor_id' => $userId,
            'process_status' => $workflowProcess->process_status,
            'process_notes' => $notes,
            'attribute' => $attribute,
            'attribute_2' => $attribute_2,
        ]);

        if ($workflowRequestCreditHistory) {
            return true;
        }

        return false;
    }

    public function submitHistoryOnly() {

    }

    public function nextProcess($currentId)
    {
        return WorkflowProcess::where('id', '>', $currentId)->orderBy('id', 'asc')->first();
    }

    public function previousProcess($currentId)
    {
        return WorkflowProcess::where('id', '<', $currentId)->orderBy('id', 'desc')->first();
    }
}
