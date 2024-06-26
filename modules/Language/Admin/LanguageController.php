<?php

namespace Modules\Language\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;
use Modules\Language\Models\Language;

class LanguageController extends AdminController
{
    public function index(Request $request)
    {
        $this->checkPermission('language_manage');
        if ($request->isMethod('post') and !empty($request->input())) {
            $this->validate($request, [
                'name'   => 'required',
                'flag'   => 'required',
                'locale' => 'required'
            ]);
            $check = Language::withTrashed()->where('locale', $request->input('locale'))->first();
            if ($check and $check->trashed()) {
                $check->restore();
                $check->fill($request->input());
                $check->save();
            } else {
                $this->validate($request, [
                    'locale' => 'unique:core_languages,locale'
                ]);
                $row = new Language($request->input());
                $row->save();
            }
            return redirect(route('language.admin.index'))->with('success', __("Language created"));
        }
        $listLanguage = Language::query();
        if (!empty($search = $request->query('s'))) {
            $listLanguage->where('name', 'LIKE', '%' . $search . '%');
            $listLanguage->Orwhere('locale', 'LIKE', '%' . $search . '%');
        }
        $listLanguage->orderBy('created_at', 'asc');
        $data = [
            'rows'        => $listLanguage->paginate(20),
            'row'         => new Language(),
            'locales'     => config('languages.locales'),
            'breadcrumbs' => [
                [
                    'name'  => __('Language Management'),
                    'class' => 'active'
                ],
            ]
        ];
        $this->setActiveMenu(route('core.admin.tool.index'));
        return view('Language::admin.language.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('language_manage');

        $row = Language::find($id);

        if (empty($row)) {
            return redirect(route('language.admin.index'));
        }


        if (!empty($request->input())) {

            $this->validate($request, [
                'name'   => 'required',
                'flag'   => 'required',
                'locale' => [
                    'required',
                    Rule::unique('core_languages')->ignore($row->id)
                ]
            ]);

            $row->fill($request->input());

            Cache::forget('locale_active_0');
            Cache::forget('locale_active_1');

            if ($row->save()) {
                return redirect()->back()->with('success', __('Language updated'));
            }
        }
        $data = [
            'row'         => $row,
            'locales'     => config('languages.locales'),
            'breadcrumbs' => [
                [
                    'name' => __('Languages'),
                    'url'  => route('language.admin.index')
                ],
                [
                    'name'  => __('Edit: :name', ['name' => $row->name]),
                    'class' => 'active'
                ],
            ]
        ];
        $this->setActiveMenu(route('core.admin.tool.index'));
        return view('Language::admin.language.detail', $data);
    }

    public function bulkEdit(Request $request)
    {
        $this->checkPermission('language_manage');

        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __("Select at least 1 item!"));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Select an Action!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = Language::where("id", $id)->first();
                if (!empty($query)) {
                    $query->delete();
                }
            }
        } else {
            foreach ($ids as $id) {
                $query = Language::where("id", $id);
                $query->update(['status' => $action]);
            }
        }
        Cache::forget('locale_active_0');
        Cache::forget('locale_active_1');
        return redirect()->back()->with('success', __('Updated success!'));
    }
}
