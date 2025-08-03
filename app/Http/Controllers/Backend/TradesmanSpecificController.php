<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\TradesmanSpecific;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class TradesmanSpecificController extends Controller {
    /**
     * Display the Tradesman Specific page.
     *
     * @return View
     */
    public function index() {
        $tradesmanSpecific = TradesmanSpecific::latest('id')->first();
        return view('backend.layouts.tradesmanSpecific.index', compact('tradesmanSpecific'));
    }

    /**
     * Update the system settings.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'image'       => 'nullable',
            'title'       => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $tradesmanSpecific              = TradesmanSpecific::firstOrNew();
            $tradesmanSpecific->title       = $request->title;
            $tradesmanSpecific->description = $request->description;

            if ($request->hasFile('image')) {
                $tradesmanSpecific->image = Helper::fileUpload($request->file('image'), 'Tradesman_Specific', $tradesmanSpecific->image);
            }

            $tradesmanSpecific->save();
            return back()->with('t-success', 'Updated successfully');
        } catch (Exception) {
            return back()->with('t-error', 'Failed to update');
        }
    }
}
