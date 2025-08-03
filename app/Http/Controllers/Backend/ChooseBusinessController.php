<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\ChooseBusiness;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ChooseBusinessController extends Controller {
    /**
     * Display a listing of Choose Business.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            $data = ChooseBusiness::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    $url = asset($data->image);
                    return '<img src="' . $url . '" alt="image" width="50px" height="50px">';
                })
                ->addColumn('description', function ($data) {
                    $description      = $data->description;
                    $shortDescription = strlen($description) > 20 ? substr($description, 0, 20) . '...' : $description;
                    return '<p>' . $shortDescription . '</p>';
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
                              <a href="' . route('choose.business.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary text-white" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="btn btn-danger text-white" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div>';
                })
                ->rawColumns(['image', 'description', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.chooseBusiness.index');
    }

    /**
     * Show the form for creating a new choose business.
     *
     * @return View
     */
    public function create(): View {
        return view('backend.layouts.chooseBusiness.create');
    }

    /**
     * Store a newly created Choose Business in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'type'        => 'required|in:pro,trade',
            'image'       => 'nullable|image',
            'title'       => 'required|string|max:100',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $chooseBusiness              = new ChooseBusiness();
            $chooseBusiness->type        = $request->type;
            $chooseBusiness->title       = $request->title;
            $chooseBusiness->description = $request->description;

            if ($request->hasFile('image')) {
                $randomString          = (string) Str::uuid();
                $Image                 = Helper::fileUpload($request->file('image'), 'Choose_Business', $request->image . '_' . $randomString);
                $chooseBusiness->image = $Image;
            }

            $chooseBusiness->save();
            return redirect()->route('choose.business.index')->with('t-success', 'Create successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to create');
        }
    }

    /**
     * Show the form for editing the specified Choose Business.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View {
        $chooseBusiness = ChooseBusiness::findOrFail($id);
        return view('backend.layouts.chooseBusiness.edit', compact('chooseBusiness'));
    }

    /**
     * Update the specified Choose Business in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'type'        => 'nullable|in:pro,trade',
            'image'       => 'nullable|image',
            'title'       => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $chooseBusiness              = ChooseBusiness::findOrFail($id);
            $chooseBusiness->type        = $request->type;
            $chooseBusiness->title       = $request->title;
            $chooseBusiness->description = $request->description;

            if ($request->hasFile('image')) {
                if ($chooseBusiness->image && File::exists(public_path($chooseBusiness->image))) {
                    File::delete(public_path($chooseBusiness->image));
                }

                $randomString          = (string) Str::uuid();
                $Image                 = Helper::fileUpload($request->file('image'), 'Choose_Business', $request->image . '_' . $randomString);
                $chooseBusiness->image = $Image;
            }

            $chooseBusiness->save();
            return redirect()->route('choose.business.index')->with('t-success', 'Update successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to update');
        }
    }

    /**
     * Toggle the status of the specified Choose Business.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $data = ChooseBusiness::findOrFail($id);

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
     * Remove the specified Choose Business from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        $chooseBusiness = ChooseBusiness::findOrFail($id);

        if (isset($chooseBusiness->image) && File::exists(public_path($chooseBusiness->image))) {
            File::delete(public_path($chooseBusiness->image));
        }

        $chooseBusiness->delete();

        return response()->json([
            't-success' => true,
            'message'   => 'Deleted successfully.',
        ]);
    }
}
