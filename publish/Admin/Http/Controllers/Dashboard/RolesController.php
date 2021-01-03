<?php

namespace Modules\Admin\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Modules\Admin\Entities\AdminRole as Role;
use Modules\Admin\Entities\AdminPermission as Permission;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $roles = Role::where('name', 'LIKE', "%$keyword%")->orWhere('label', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $roles = Role::latest()->paginate($perPage);
        }

        return view('admin::dashboard.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $permissions = Permission::select('id', 'name', 'label')->get()->pluck('label', 'name');

        return view('admin::dashboard.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return void
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);

        $role = Role::create($request->all());
        $role->permissions()->detach();

        if ($request->filled('permissions')) {
            foreach ($request->permissions as $permission_name) {
                $permission = Permission::whereName($permission_name)->first();
                $role->givePermissionTo($permission);
            }
        }

        return redirect()->route('admin.roles.index')->with('success', __('Role added!'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return void
     */
    public function show(int $id)
    {
        $role = Role::findOrFail($id);

        return view('admin::dashboard.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return void
     */
    public function edit(int $id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::select('id', 'name', 'label')->get()->pluck('label', 'name');

        return view('admin::dashboard.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     *
     * @return void
     * @throws ValidationException
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request, ['name' => 'required']);

        $role = Role::findOrFail($id);
        $role->update($request->all());
        $role->permissions()->detach();
        if ($request->filled('permissions')) {

            foreach ($request->permissions as $permission_name) {
                $permission = Permission::whereName($permission_name)->first();
                $role->givePermissionTo($permission);
            }
        }

        return redirect()->route('admin.roles.index')->with('success', __('Role updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return void
     */
    public function destroy(int $id)
    {
        Role::destroy($id);

        return redirect()->route('admin.roles.index')->with('success', __('Role deleted!'));
    }
}
