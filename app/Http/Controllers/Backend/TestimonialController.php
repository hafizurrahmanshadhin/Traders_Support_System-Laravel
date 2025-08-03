<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class TestimonialController extends Controller {
    /**
     * Display a listing of the testimonials.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            $data = Testimonial::latest();
            return DataTables::of($data)
                ->addIndexColumn()
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
                              <a href="' . route('testimonial.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary text-white" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="btn btn-danger text-white" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div>';
                })
                ->rawColumns(['description', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.testimonial.index');
    }

    /**
     * Show the form for creating a new testimonials.
     *
     * @return View
     */
    public function create(): View {
        return view('backend.layouts.testimonial.create');
    }

    /**
     * Store a newly created testimonials in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'type'        => 'required|string|max:100',
            'description' => 'required|string',
            'name'        => 'required|string|max:100',
            'rating'      => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $testimonial              = new Testimonial();
            $testimonial->type        = $request->type;
            $testimonial->description = $request->description;
            $testimonial->name        = $request->name;
            $testimonial->rating      = $request->rating;

            $testimonial->save();
            return redirect()->route('testimonial.index')->with('t-success', 'Create successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to create');
        }
    }

    /**
     * Show the form for editing the specified testimonial.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View {
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.layouts.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified testimonial in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'type'        => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'name'        => 'nullable|string|max:100',
            'rating'      => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $testimonial              = Testimonial::findOrFail($id);
            $testimonial->type        = $request->type;
            $testimonial->description = $request->description;
            $testimonial->name        = $request->name;
            $testimonial->rating      = $request->rating;

            $testimonial->save();
            return redirect()->route('testimonial.index')->with('t-success', 'Update successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to update');

        }
    }

    /**
     * Toggle the status of the specified testimonial.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $data = Testimonial::findOrFail($id);

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
     * Remove the specified testimonial from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return response()->json([
            't-success' => true,
            'message'   => 'Deleted successfully.',
        ]);
    }
}
