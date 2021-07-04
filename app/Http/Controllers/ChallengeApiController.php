<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\User;
use App\Submission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class ChallengeApiController extends Controller
{
    public function getChallenges(){
        $challenges = Challenge::whereDate('date_end_submission', '>', Carbon::today())->get();

        return response()->json([
            'success' => true,
            'data' => $challenges,
            'pesan' => 'Success'
        ], 200);
    }

    public function storeChallenge(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'max:255'],
            'desc' => ['required'],
            'date_start_submission' => ['required'],
            'date_end_submission' => ['required'],
            'date_announcement' => ['required'],
            'id_host' => ['required'],
            'further_desc_link' => ['required'],
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'pesan' => "Invalid form"
            ], 403);
        }else{
            $challenge = new Challenge();
            $challenge->title = $request->title;
            $challenge->desc = $request->desc;
            $challenge->date_start_submission = $request->date_start_submission;
            $challenge->date_end_submission = $request->date_end_submission;
            $challenge->date_announcement = $request->date_announcement;
            $challenge->id_host = $request->id_host;
            $challenge->further_desc_link = $request->further_desc_link;
            $challenge->save();

            $host = User::find($request->id_host);
            $host->count_challenges_hosted += 1;
            $host->save();

            return response()->json([
                'success' => true,
                'data' => $challenge,
                'pesan' => 'Success'
            ], 200);
        }
    }

    public function storeSubmission(Request $request){
        $validator = Validator::make($request->all(), [
            'id_challenge' => ['required'],
            'id_user' => ['required'],
            'link' => ['required'],
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'pesan' => "Invalid form"
            ], 403);
        }
        else{
            $submission = new Submission();
            $submission->id_challenge = $request->id_challenge;
            $submission->id_user = $request->id_user;
            $submission->link = $request->link;
            if($request->desc){
                $submission->desc = $request->desc;
            }
            $submission->save();

            $user = User::find($submission->id_user);
            $user->count_challenges_joined += 1;
            $user->save();

            return response()->json([
                'success' => true,
                'data' => $submission,
                'pesan' => 'Success'
            ], 200);
        }
    }
}
