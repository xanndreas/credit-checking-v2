<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Controllers\Traits\TenantTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    use MediaUploadingTrait, TenantTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = User::with(['roles'])->select(sprintf('%s.*', (new User)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
                $otherDetailGate = 'user_show';
                $otherDetailUrl = route('admin.users.show', ['user' => $row->id]);
                $crudRoutePart = 'users';

                return view('_partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'otherDetailGate',
                    'otherDetailUrl',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->editColumn('roles', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('role_ids', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = $role->id;
                }

                return $labels;
            });

            $table->rawColumns(['actions', 'placeholder', 'approved', 'roles']);

            return $table->make(true);
        }

        $roles = Role::pluck('title', 'id');

        return view('admin.users.index', compact('roles'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('profile', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile'))))->toMediaCollection('profile');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('profile', false)) {
            if (!$user->profile || $request->input('profile') !== $user->profile->file_name) {
                if ($user->profile) {
                    $user->profile->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile'))))->toMediaCollection('profile');
            }
        } elseif ($user->profile) {
            $user->profile->delete();
        }

        return redirect()->route('admin.users.index');
    }

    public function show(User $user, Request $request)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {

            $teamTree = [[
                'tt_key' => $user->id,
                'tt_parent' => 0,
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'status' => $user->approved == 1 ? 'Active' : 'Inactive',
                'roles' => $user->roles->first()->title,
                'children' => []
            ]];

            $users = User::with(['roles'])->whereIn('id', $this->tenantChildUserTree($user->id))->get();
            foreach ($users as $user) {
                $parent = UserTenant::with('user')
                    ->where('user_id', $user->id)
                    ->where('parent_id', '!=', null)
                    ->first();

                $teamTree[] = [
                    'tt_key' => $user->id,
                    'tt_parent' => $parent ? $parent->parent_id : 0,
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => $user->email_verified_at,
                    'status' => $user->approved == 1 ? 'Active' : 'Inactive',
                    'roles' => $user->roles->first()->title,
                    'children' => []
                ];
            }

            $teamTreeOrderChild = $this->unflattering($teamTree);
            $teamTreeFlatten = $this->flattenArray($teamTreeOrderChild);

            return response()->json($teamTreeFlatten);
        }

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }
}
