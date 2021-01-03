<?php

namespace Modules\Admin\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Modules\Admin\Entities\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
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
            $pages = Page::where('title', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $pages = Page::latest()->paginate($perPage);
        }

        return view('admin::dashboard.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin::dashboard.pages.create');
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
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);
        $requestData = $request->all();

        Page::create($requestData);

        return redirect()->route('admin.pages.index')->with('success', __('Page added!'));
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
        $page = Page::findOrFail($id);

        return view('admin::dashboard.pages.show', compact('page'));
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
        $page = Page::findOrFail($id);

        return view('admin::dashboard.pages.edit', compact('page'));
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
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);
        $requestData = $request->all();

        $page = Page::findOrFail($id);
        $page->update($requestData);

        return redirect()->route('admin.pages.index')->with('success', __('Page updated!'));
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
        Page::destroy($id);

        return redirect()->route('admin.pages.index')->with('success', __('Page deleted!'));
    }
}
