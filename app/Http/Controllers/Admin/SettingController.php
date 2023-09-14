<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\LoginLog;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        $permissionParsed = null;
        foreach (Permission::all() as $item) {
            $explodes = explode('_', $item->title);
            $permissionGroup = array_slice($explodes, 0, -1);

            $permissionParsed[ucwords(implode(" ", $permissionGroup))][] = [
                'key' => $item->id,
                'value' => ucwords(end($explodes))
            ];
        }

        return view('admin.settings.index', compact('permissionParsed'));
    }

    public function loginLogs(Request $request)
    {
        if ($request->ajax()) {
            $query = LoginLog::query()->select(sprintf('%s.*', (new LoginLog)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('authenticatable_type', function ($row) {
                return $row->authenticatable_type ? $row->authenticatable_type : '';
            });

            $table->editColumn('authenticatable_id', function ($row) {
                return $row->authenticatable_id ?  $row->authenticatable_id : '';
            });

            $table->editColumn('authenticatable_name', function ($row) {
                $auth = User::where('id', $row->authenticatable_id)->first();

                return $auth ? $auth->name : '';
            });

            $table->editColumn('user_agent', function ($row) {
                return $row->user_agent ? $row->user_agent : '';
            });

            $table->editColumn('login_at', function ($row) {
                return $row->login_at ? $row->login_at : '';
            });

            $table->editColumn('login_successful', function ($row) {
                return $row->login_successful ? $row->login_successful : '';
            });

            $table->editColumn('logout_at', function ($row) {
                return $row->logout_at ? $row->logout_at : '';
            });

            $table->editColumn('cleared_by_user', function ($row) {
                return $row->cleared_by_user ? $row->cleared_by_user : '';
            });

            $table->editColumn('location', function ($row) {
                return $row->location ? $row->location : '';
            });

            $table->rawColumns(['placeholder']);

            return $table->make(true);
        }


        return response(null, Response::HTTP_FORBIDDEN);
    }

    public function update(Request $request)
    {

    }
}
