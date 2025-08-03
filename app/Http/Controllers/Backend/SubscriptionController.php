<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SubscriptionController extends Controller {
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Subscription::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('feature', function ($data) {
                    $feature      = $data->feature;
                    $shortFeature = strlen($feature) > 50 ? substr($feature, 0, 50) . '...' : $feature;
                    return '<p>' . $shortFeature . '</p>';
                })
                ->addColumn('status', function ($data) {
                    $status = ' <div class="form-check form-switch" style="margin-left:40px;">';
                    $status .= ' <input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status"';
                    if ($data->status == 'active') {
                        $status .= 'checked';
                    }
                    $status .= '><label for="customSwitch' . $data->id . '" class="form-check-label" for="customSwitch"></label></div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <a href="' .
                    route('admin.subscription.edit', ['id' => $data->id]) .
                    '" type="button" class="btn btn-primary text-white" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' .
                    $data->id .
                        ')" type="button" class="btn btn-danger text-white" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div>';
                })
                ->rawColumns(['feature', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.subscription.index');
    }

    public function create() {
        return view('backend.layouts.subscription.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_type'        => 'required',
            'package_type'     => 'required',
            'price'            => 'required|string',
            'timeline'         => 'required|string|max:100',
            'package_duration' => 'required',
            'view_limit'       => 'nullable|numeric|min:0',
            'message_limit'    => 'nullable|numeric|min:0',
            'feature'          => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $subscription = new Subscription();

            $subscription->user_type        = $request->user_type;
            $subscription->package_type     = $request->package_type;
            $subscription->price            = $request->price;
            $subscription->timeline         = $request->timeline;
            $subscription->package_duration = $request->package_duration;
            $subscription->view_limit       = $request->view_limit;
            $subscription->message_limit    = $request->message_limit;
            $subscription->feature          = $request->feature;

            $subscription->save();
            return redirect()->route('admin.subscription.index')->with('t-success', 'Create successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to create');
        }
    }

    public function edit(int $id) {
        $subscription = Subscription::findOrFail($id);
        return view('backend.layouts.subscription.edit', compact('subscription'));
    }

    public function update(Request $request, int $id) {
        $validator = Validator::make($request->all(), [
            'user_type'        => 'nullable',
            'package_type'     => 'nullable',
            'price'            => 'nullable',
            'timeline'         => 'nullable',
            'package_duration' => 'nullable',
            'view_limit'       => 'nullable|numeric|min:0',
            'message_limit'    => 'nullable|numeric|min:0',
            'feature'          => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $subscription = Subscription::findOrFail($id);

            $subscription->user_type        = $request->user_type;
            $subscription->package_type     = $request->package_type;
            $subscription->price            = $request->price;
            $subscription->timeline         = $request->timeline;
            $subscription->package_duration = $request->package_duration;
            $subscription->view_limit       = $request->view_limit;
            $subscription->message_limit    = $request->message_limit;
            $subscription->feature          = $request->feature;

            $subscription->save();
            return redirect()->route('admin.subscription.index')->with('t-success', 'Update successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to update');
        }
    }

    public function status(int $id) {
        $data = Subscription::findOrFail($id);

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

    public function destroy(int $id) {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return response()->json([
            't-success' => true,
            'message'   => 'Deleted successfully.',
        ]);
    }
}
