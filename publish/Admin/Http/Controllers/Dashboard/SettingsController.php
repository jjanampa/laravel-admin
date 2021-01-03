<?php

namespace Modules\Admin\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Modules\Admin\Entities\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $settings = Setting::where('key', 'LIKE', "%$keyword%")
                ->orWhere('value', 'LIKE', "%$keyword%")
                ->orderBy('key')->paginate($perPage);
        } else {
            $settings = Setting::orderBy('key')->paginate($perPage);
        }

        return view('admin::dashboard.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin::dashboard.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'key' => 'required|string|unique:settings',
                'value' => 'required'
            ]
        );

        $requestData = $request->all();

        Setting::create($requestData);

        $keyCachePrefixSetting = 'admin.cache.setting_';
        $keyCache = $keyCachePrefixSetting.$request->input('key');
        cache()->forget($keyCache);

        return redirect()->route('admin.settings.index')->with('success', __('Setting added!'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return View
     */
    public function show(int $id): View
    {
        $setting = Setting::findOrFail($id);

        return view('admin::dashboard.settings.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return View
     */
    public function edit(int $id): View
    {
        $setting = Setting::findOrFail($id);

        return view('admin::dashboard.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function update(Request $request, int $id)
    {
        $this->validate(
            $request,
            [
                'key' => 'required|string|unique:settings,key,' . $id,
                'value' => 'required'
            ]
        );
        $requestData = $request->all();

        $setting = Setting::findOrFail($id);
        $setting->update($requestData);

        $keyCachePrefixSetting = 'admin.cache.setting_';
        $keyCache = $keyCachePrefixSetting.$request->input('key');
        cache()->forget($keyCache);

        return redirect()->route('admin.settings.index')->with('success', __('Setting updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        Setting::destroy($id);

        return redirect()->route('admin.settings.index')->with('success', __('Setting deleted!'));
    }
}
