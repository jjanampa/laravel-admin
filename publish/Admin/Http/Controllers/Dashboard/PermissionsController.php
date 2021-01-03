<?php

namespace Modules\Admin\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Modules\Admin\Entities\AdminPermission as Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
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
            $permissions = Permission::where('name', 'LIKE', "%$keyword%")->orWhere('label', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $permissions = Permission::latest()->paginate($perPage);
        }

        return view('admin::dashboard.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin::dashboard.permissions.create');
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
        $keyCache = 'admin.cache.permissions';
        cache()->forget($keyCache);
        Permission::create($request->all());

        return redirect()->route('admin.permissions.index')->with('success', __('Permission added!'));
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
        $permission = Permission::findOrFail($id);

        return view('admin::dashboard.permissions.show', compact('permission'));
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
        $permission = Permission::findOrFail($id);

        return view('admin::dashboard.permissions.edit', compact('permission'));
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
        cache()->forget('permisions.cache');
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());

        return redirect()->route('admin.permissions.index')->with('success', __('Permission updated!'));
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
        Permission::destroy($id);

        return redirect()->route('admin.permissions.index')->with('success', __('Permission deleted!'));
    }
}
