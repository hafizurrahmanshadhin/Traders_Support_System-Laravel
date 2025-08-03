<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\HelpBusiness;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class HelpBusinessController extends Controller {
    /**
     * Display a listing of Need Help In Your Business?
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            $data = HelpBusiness::latest();
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
                              <a href="' . route('help.business.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary text-white" title="Edit">
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
        return view('backend.layouts.helpBusiness.index');
    }

    /**
     * Show the form for creating a new Help Business.
     *
     * @return View
     */
    public function create(): View {
        return view('backend.layouts.helpBusiness.create');
    }

    /**
     * Store a newly created Help Business in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'type'        => 'required|in:pro,trade',
            'image'       => 'nullable',
            'title'       => 'required|string|max:100',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $helpBusiness              = new HelpBusiness();
            $helpBusiness->type        = $request->type;
            $helpBusiness->title       = $request->title;
            $helpBusiness->description = $request->description;

            if ($request->hasFile('image')) {
                $randomString        = (string) Str::uuid();
                $Image               = Helper::fileUpload($request->file('image'), 'Help_Business', $request->image . '_' . $randomString);
                $helpBusiness->image = $Image;
            }

            $helpBusiness->save();
            return redirect()->route('help.business.index')->with('t-success', 'Create successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to create');
        }
    }

    /**
     * Show the form for editing the specified Help Business.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View {
        $helpBusiness = HelpBusiness::findOrFail($id);
        return view('backend.layouts.helpBusiness.edit', compact('helpBusiness'));
    }

    /**
     * Update the specified Help Business in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'type'        => 'nullable|in:pro,trade',
            'image'       => 'nullable',
            'title'       => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $helpBusiness              = HelpBusiness::findOrFail($id);
            $helpBusiness->type        = $request->type;
            $helpBusiness->title       = $request->title;
            $helpBusiness->description = $request->description;

            if ($request->hasFile('image')) {
                if ($helpBusiness->image && File::exists(public_path($helpBusiness->image))) {
                    File::delete(public_path($helpBusiness->image));
                }

                $randomString        = (string) Str::uuid();
                $Image               = Helper::fileUpload($request->file('image'), 'Help_Business', $request->image . '_' . $randomString);
                $helpBusiness->image = $Image;
            }

            $helpBusiness->save();
            return redirect()->route('help.business.index')->with('t-success', 'Update successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to update');
        }
    }

    /**
     * Toggle the status of the specified Help Business.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $data = HelpBusiness::findOrFail($id);

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
     * Remove the specified Help Business from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        $helpBusiness = HelpBusiness::findOrFail($id);
        if (isset($helpBusiness->image) && File::exists(public_path($helpBusiness->image))) {
            File::delete(public_path($helpBusiness->image));
        }
        $helpBusiness->delete();

        return response()->json([
            't-success' => true,
            'message'   => 'Deleted successfully.',
        ]);
    }
}
