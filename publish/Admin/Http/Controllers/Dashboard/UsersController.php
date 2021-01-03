<?php

namespace Modules\Admin\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Modules\Admin\Entities\AdminRole as Role;
use Modules\Admin\Entities\AdminUser as User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class UsersController extends Controller
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
            $users = User::where('name', 'LIKE', "%$keyword%")->orWhere('email', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $users = User::latest()->paginate($perPage);
        }

        return view('admin::dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $user = new User;
        $roles = Role::select('id', 'name', 'label')->get();
        $roles = $roles->pluck('label', 'name');
        $user_roles = [];

        return view('admin::dashboard.users.create', compact('roles', 'user', 'user_roles'));
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
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|string|max:255|email|unique:admin_users',
                'password' => 'required',
                'roles' => 'required'
            ]
        );

        $data = $request->except('password');
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);

        foreach ($request->roles as $role) {
            $user->assignRole($role);
        }

        return redirect()->route('admin.users.index')->with('success', __('User added!'));
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
        $user = User::findOrFail($id);

        $activitylogs = Activity::where(['causer_id' => $id, 'log_name' => 'admin'])->latest()->paginate(15);

        return view('admin::dashboard.users.show', compact('user', 'activitylogs'));
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
        $roles = Role::select('id', 'name', 'label')->get();
        $roles = $roles->pluck('label', 'name');

        $user = User::with('roles')->select('id', 'name', 'email')->findOrFail($id);
        $user_roles = [];
        foreach ($user->roles as $role) {
            $user_roles[] = $role->name;
        }

        return view('admin::dashboard.users.edit', compact('user', 'roles', 'user_roles'));
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
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|string|max:255|email|unique:admin_users,email,' . $id,
                'roles' => 'required'
            ]
        );

        $data = $request->except('password');

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user = User::findOrFail($id);
        $user->update($data);

        $user->roles()->detach();
        foreach ($request->roles as $role) {
            $user->assignRole($role);
        }

        return redirect()->route('admin.users.index')->with('success', __('User updated!'));
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
        User::destroy($id);

        return redirect()->route('admin.users.index')->with('success', __('User deleted!'));
    }
}
