<?php

namespace App\Http\Controllers\Api\Pro;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExperenceController extends Controller
{
    use apiresponse;
    /**
     * Get My Experences
     * @return JsonResponse
     */
    public function index()
    {
        $experence = Experience::where('user_id', Auth::id())->get();
        return $this->success($experence, 'Experence fetched successfully', 200);
    }

    /**
     * Create A experence
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'designation' => 'required|string|max:100',
            'details' => 'nullable|string|max:100',
            'starting_date' => 'required|string|date_format:Y-m-d',
            'ending_date' => 'nullable|string|date_format:Y-m-d',
            'company_location' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error(null, $validator->errors(), 422);
        }
        try {
            $experence = Experience::create([
                'user_id' => Auth::id(),
                'company_name' => $request->company_name,
                'designation' => $request->designation,
                'details' => $request->details,
                'starting_date' => $request->starting_date,
                'ending_date' => $request->ending_date,
                'company_location' => $request->company_location,
            ]);
            return $this->success($experence, 'Experence created successfully', 200);
        } catch (\Exception $e) {
            return $this->error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Update Experence
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'designation' => 'required|string|max:100',
            'details' => 'nullable|string|max:100',
            'starting_date' => 'required|string|date_format:Y-m-d',
            'ending_date' => 'nullable|string|date_format:Y-m-d',
            'company_location' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return $this->error(null, $validator->errors(), 422);
        }
        try {
            $experence = Experience::find($id);
            if (!$experence && $experence->user_id != Auth::id()) {
                return $this->error(null, 'Experence not found', 404);
            }
            $experence->update([
                'company_name' => $request->company_name,
                'designation' => $request->designation,
                'details' => $request->details,
                'starting_date' => $request->starting_date,
                'ending_date' => $request->ending_date,
                'company_location' => $request->company_location,
            ]);
            return $this->success($experence, 'Experence updated successfully', 200);
        } catch (\Exception $e) {
            return $this->error(null, $e->getMessage(), 500);
        }
    }


    /**
     * Delete Experence
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $experence = Experience::find($id);
        if (!$experence && $experence->user_id != Auth::id()) {
            return $this->error(null, 'Experence not found', 404);
        }
        $experence->delete();
        return $this->success(null, 'Experence deleted successfully', 200);
    }
}
