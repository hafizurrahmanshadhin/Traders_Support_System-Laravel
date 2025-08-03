<?php

namespace App\Http\Controllers\Api;

use App\Models\Question;
use App\Traits\apiresponse;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    use apiresponse;
    /**
     * Ocupation Controller
     * @return \Illuminate\Http\Response
     */
    public function getOcupation()
    {
        $question = Question::where('category', 'register')
            ->where('status', 'active')
            ->with(['options' => function ($query) {
                $query->select('question_id', 'option_text');
            }])
            ->first(['id', 'question_text']);

        if (!$question) {
            $question = (object) [
                "id" => 1,
                "question_text" => "What is your primary Trade Experience?",
                "options" => [
                    (object) [
                        "question_id" => 1,
                        "option_text" => "HVAC Technician",
                    ],
                    (object) [
                        "question_id" => 1,
                        "option_text" => "Electrician",
                    ],
                    (object) [
                        "question_id" => 1,
                        "option_text" => "Carpenter",
                    ],
                    (object) [
                        "question_id" => 1,
                        "option_text" => "Plumber",
                    ],
                    (object) [
                        "question_id" => 1,
                        "option_text" => "Welder",
                    ],
                    (object) [
                        "question_id" => 1,
                        "option_text" => "Mason",
                    ],
                    (object) [
                        "question_id" => 1,
                        "option_text" => "Excavator",
                    ],
                    (object) [
                        "question_id" => 1,
                        "option_text" => "Contractor",
                    ],
                    (object) [
                        "question_id" => 1,
                        "option_text" => "Handyman",
                    ],
                    (object) [
                        "question_id" => 1,
                        "option_text" => "Facility Maintenance",
                    ],
                    (object) [
                        "question_id" => 1,
                        "option_text" => "Painter/Drywaller",
                    ],
                    (object) [
                        "question_id" => 1,
                        "option_text" => "Roofer",
                    ],
                    (object) [
                        "question_id" => 1,
                        "option_text" => "Locksmith",
                    ],
                    (object) [
                        "question_id" => 1,
                        "option_text" => "Other",
                    ],
                ],
            ];

        }

        return $this->success([
            'question' => $question,
        ], "Ocupation fetched successfully", 200);

    }



    /**
     * Get All Pro Usbscriptions
     * @return \Illuminate\Http\Response
     */
    public function getProSubscriptions(){
        $subscription = Subscription::where('user_type', 'pro')->where('status', 'active')->get();

        return $this->success([
            'subscriptions' => $subscription,
        ], "Subscription fetched successfully", 200);
    }


    /**
     * Get All Tread Usbscriptions
     * @return \Illuminate\Http\Response
     */
    public function getTreadSubscriptions(){
        $subscription = Subscription::where('user_type', 'trade')->where('status', 'active')->get();

        return $this->success([
            'subscriptions' => $subscription,
        ], "Subscription fetched successfully", 200);
    }
}
