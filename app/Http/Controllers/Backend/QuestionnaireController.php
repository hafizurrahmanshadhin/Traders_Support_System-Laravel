<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class QuestionnaireController extends Controller {
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Question::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('question_text', function ($data) {
                    $question_text      = $data->question_text;
                    $shortQuestion_text = strlen($question_text) > 100 ? substr($question_text, 0, 100) . '...' : $question_text;
                    return '<p>' . $shortQuestion_text . '</p>';
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
                                <a href="#" onclick="editQuestion(' . $data->id . ')" type="button" class="btn btn-primary text-white" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a href="#" onclick="viewQuestion(' . $data->id . ')" type="button" class="btn btn-info text-white" title="View">
                                <i class="bi bi-eye"></i>
                                </a>

                                <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="btn btn-danger text-white" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['question_text', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.questionnaires.index');
    }

    public function show($id) {
        $question = Question::findOrFail($id);
        $options  = $question->options()->get();

        return response()->json([
            'question' => $question,
            'options'  => $options,
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'question_text' => 'required|string',
            'type'          => 'required|in:radio,checkbox,textarea,file',
            'category'      => 'required|in:pro,trade,register',
            'option_text'   => 'nullable|array',
            'option_text.*' => 'required_with:option_text|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the question
        $question = Question::create([
            'question_text' => $request->question_text,
            'type'          => $request->type,
            'category'      => $request->category,
        ]);

        // Create options if the type is radio or checkbox
        if ($request->has('option_text') && ($request->type == 'radio' || $request->type == 'checkbox')) {
            foreach ($request->option_text as $optionText) {
                Option::create([
                    'question_id' => $question->id,
                    'option_text' => $optionText,
                    'status'      => 'active',
                ]);
            }
        }
        return redirect()->route('questions.index')->with('t-success', 'Question and options added successfully!');
    }

    public function edit($id) {
        $question = Question::findOrFail($id);
        $options  = $question->options()->get();

        return response()->json([
            'question' => $question,
            'options'  => $options,
        ]);
    }
    public function update(Request $request, $id) {
        $request->validate([
            'question_text' => 'nullable|string',
            'type'          => 'nullable|in:radio,checkbox,textarea,file',
            'category'      => 'nullable|in:pro,trade,register',
            'option_text'   => 'nullable|array',
            'option_text.*' => 'nullable|string',
        ]);

        $question = Question::findOrFail($id);
        $question->update([
            'question_text' => $request->question_text,
            'type'          => $request->type,
            'category'      => $request->category,
        ]);

        if ($request->has('option_text') && ($request->type == 'radio' || $request->type == 'checkbox')) {
            $existingOptionIds  = $question->options->pluck('id')->toArray();
            $submittedOptionIds = $request->input('option_id', []);
            $optionsToDelete    = array_diff($existingOptionIds, $submittedOptionIds);
            Option::destroy($optionsToDelete);

            foreach ($request->option_text as $index => $optionText) {
                $optionId = $request->option_id[$index] ?? null;
                if ($optionId) {
                    $option = Option::findOrFail($optionId);
                    $option->update(['option_text' => $optionText]);
                } else {
                    $question->options()->create([
                        'option_text' => $optionText,
                    ]);
                }
            }
        }

        return redirect()->route('questions.index')->with('t-success', 'Question and options updated successfully!');
    }

    public function status(int $id) {
        $data = Question::findOrFail($id);

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
        $question = Question::findOrFail($id);
        $question->delete();

        return response()->json([
            't-success' => true,
            'message'   => 'Deleted successfully.',
        ]);
    }
}
