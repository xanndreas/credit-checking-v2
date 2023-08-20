<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRequestCreditHelpRequest;
use App\Http\Requests\StoreRequestCreditHelpRequest;
use App\Http\Requests\UpdateRequestCreditHelpRequest;
use App\Models\Permission;
use App\Models\RequestCreditHelp;
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

    public function update(Request $request)
    {

    }
}
