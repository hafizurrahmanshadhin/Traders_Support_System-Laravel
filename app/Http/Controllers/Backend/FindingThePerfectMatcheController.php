<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\FindingThePerfectMatche;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class FindingThePerfectMatcheController extends Controller {
    /**
     * Display a listing of Partner_Match
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            $data = FindingThePerfectMatche::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    $url = asset($data->image);
                    return '<img src="' . $url . '" alt="image" width="50px" height="50px">';
                })
                ->addColumn('status', function ($data) {
                    $status = ' <div class="form-check form-switch" style="margin-left:40px;">';
                    $status .= ' <input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status"';
                    if ($data->status == "active") {
                        $status .= "checked";
                    }
                    $status .= '><label for="customSwitch' . $data->id . '" class="form-check-label" for="customSwitch"></label></div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <a href="' . route('partner.match.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary text-white" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="btn btn-danger text-white" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div>';
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.findingThePerfectMatche.index');
    }

    /**
     * Show the form for creating a new Partner_Match
     *
     * @return View
     */
    public function create(): View {
        return view('backend.layouts.findingThePerfectMatche.create');
    }

    /**
     * Store a newly created Partner_Match in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable',
            'title' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $findingThePerfectMatche        = new FindingThePerfectMatche();
            $findingThePerfectMatche->title = $request->title;

            if ($request->hasFile('image')) {
                $randomString                   = (string) Str::uuid();
                $Image                          = Helper::fileUpload($request->file('image'), 'Partner_Match', $request->image . '_' . $randomString);
                $findingThePerfectMatche->image = $Image;
            }

            $findingThePerfectMatche->save();
            return redirect()->route('partner.match.index')->with('t-success', 'Create successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to create');
        }
    }

    /**
     * Show the form for editing the specified Partner_Match
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View {
        $findingThePerfectMatche = FindingThePerfectMatche::findOrFail($id);
        return view('backend.layouts.findingThePerfectMatche.edit', compact('findingThePerfectMatche'));
    }

    /**
     * Update the specified Partner_Match in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable',
            'title' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $findingThePerfectMatche        = FindingThePerfectMatche::findOrFail($id);
            $findingThePerfectMatche->title = $request->title;

            if ($request->hasFile('image')) {
                if ($findingThePerfectMatche->image && File::exists(public_path($findingThePerfectMatche->image))) {
                    File::delete(public_path($findingThePerfectMatche->image));
                }

                $randomString                   = (string) Str::uuid();
                $Image                          = Helper::fileUpload($request->file('image'), 'Partner_Match', $request->image . '_' . $randomString);
                $findingThePerfectMatche->image = $Image;
            }

            $findingThePerfectMatche->save();
            return redirect()->route('partner.match.index')->with('t-success', 'Update successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to update');
        }
    }

    /**
     * Toggle the status of the specified Partner_Match
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $data = FindingThePerfectMatche::findOrFail($id);

        if ($data->status == 'active') {
            $data->status = 'inactive';
            $data->save();
            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
                'data'    => $data,
            ]);
        } else {
            $data->status = 'active';
            $data->save();
            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
                'data'    => $data,
            ]);
        }
    }

    /**
     * Remove the specified Partner_Match from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        $findingThePerfectMatche = FindingThePerfectMatche::findOrFail($id);
        if (isset($findingThePerfectMatche->image) && File::exists(public_path($findingThePerfectMatche->image))) {
            File::delete(public_path($findingThePerfectMatche->image));
        }
        $findingThePerfectMatche->delete();

        return response()->json([
            't-success' => true,
            'message'   => 'Deleted successfully.',
        ]);
    }
}
