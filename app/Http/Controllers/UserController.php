<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\Notification;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function send(Request $request): RedirectResponse
    {
        $message = 'Mail not sent';

        $saveNotice = Notification::query()->create([
            'name' => $request->contact_name,
            'message' => $request->contact_message,
            'email' => $request->contact_email,
            'visitor_id' => $request->visitor_id
        ]);

        if ($saveNotice){
            $message = 'Mail sent';
            $data = [
                'name' => $request->contact_name,
                'message' => $request->contact_message,
                'email' => $request->contact_email,
            ];

            try {
                SendEmailJob::dispatch($data);
            }catch (Exception $e){
                Log::info('message',[$e->getMessage()]);
            }
        }

        return redirect()->back()->with('message', $message);
    }
}
