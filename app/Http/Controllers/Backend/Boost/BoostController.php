<?php

namespace App\Http\Controllers\Backend\Boost;

use App\Http\Controllers\Controller;
use App\Models\Boost;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Exception;
use Carbon\Carbon;

class BoostController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Boost::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <a href="' .
                        route('admin.boost.edit', ['id' => $data->id]) .
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
                ->addColumn('package_duration', function ($data) {
                    return "<span class='badge bg-danger'>" . $data->package_duration . " Minutes</span>";
                })
                ->rawColumns(['action','package_duration'])
                ->make();
        }
        return view('backend.layouts.boost.index');
    }

    public function create()
    {
        // return view('backend.layouts.boost.create');
    }

    // public function store(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'price' => 'required',
    //         'package_duration' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     try {
    //         $boost = new Boost();
    //         $boost->name = $request->name;
    //         $boost->price = $request->price;
    //         $boost->package_duration = $request->package_duration;
    //         $start_date = Carbon::now();
    //         $end_date = $start_date->copy()->addMinutes($request->package_duration);

    //         $boost->start_date = $start_date;
    //         $boost->end_date = $end_date;

    //         $boost->save();
    //         return redirect()->route('admin.boost.index')->with('t-success', 'Create successfully');
    //     } catch (Exception) {
    //         return redirect()->back()->with('t-error', 'Failed to create');
    //     }
    // }

    public function store(Request $request)
    {
        return false;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'package_duration' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Enforce only one Boost record in the database
            $boost = Boost::firstOrNew(['id' => 1]);

            // Set or update the properties
            $boost->name = $request->name;
            $boost->price = $request->price;
            $boost->package_duration = $request->package_duration;
            $start_date = Carbon::now();
            $end_date = $start_date->copy()->addMinutes($request->package_duration);

            $boost->start_date = $start_date;
            $boost->end_date = $end_date;

            // Save the Boost instance to the database
            $boost->save();

            return redirect()
                ->route('admin.boost.index')
                ->with('t-success', $boost->wasRecentlyCreated ? 'Created successfully' : 'Updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to create or update');
        }
    }

    public function edit(int $id)
    {
        $boost = Boost::findOrFail($id);
        return view('backend.layouts.boost.edit', compact('boost'));
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable',
            'price' => 'nullable',
            'package_duration' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $boost = Boost::findOrFail($id);
            $boost->name = $request->name;
            $boost->price = $request->price;
            $boost->package_duration = $request->package_duration;
            $boost->save();
            return redirect()->route('admin.boost.index')->with('t-success', 'Update successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to update');
        }
    }

    public function destroy(int $id)
    {
        $boost = Boost::findOrFail($id);
        $boost->delete();

        return response()->json([
            't-success' => true,
            'message' => 'Deleted successfully.',
        ]);
    }
}
