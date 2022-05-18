<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\GetInTouchRequest;
use App\Models\Users\Feedback;
use App\Models\Users\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AboutusController extends Controller
{
    public function feedback(Request $request){
        $request->validate([
            'message'=>'required|max:400|min:10|string',
        ]);
        $user_id =Auth::id();
        $feedback =Feedback::where('user_id',$user_id)->first();
        if (!$feedback) {
            Feedback::create([
                'user_id' => $user_id,
                'message' => $request->message,
            ]);
            return Api_response('Thanks for the feedback',200);
        }
        return Api_response('You already give us feedback Thanks',419);

    }

    public function message(GetInTouchRequest $request){
        $user_id =Auth::id();
        $Todaymassage = Message::where('user_id',$user_id)->whereDate('created_at',Carbon::today())->first();
        if (!empty($Todaymassage)) {
            return Api_response('You can only send 1 msg in day',429);
        }
        Message::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        return Api_response('Message send successfully',200);
    }
}


