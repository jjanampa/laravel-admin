<?php

namespace Modules\Admin\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;

class ActivityLogsController extends Controller
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
            $activitylogs = Activity::where('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $activitylogs = Activity::latest()->paginate($perPage);
        }

        return view('admin::dashboard.activitylogs.index', compact('activitylogs'));
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
        $activitylog = Activity::findOrFail($id);

        return view('admin::dashboard.activitylogs.show', compact('activitylog'));
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
        Activity::destroy($id);

        return redirect()->route('admin.activitylogs.index')->with('success', __('Activity deleted!'));
    }
}
