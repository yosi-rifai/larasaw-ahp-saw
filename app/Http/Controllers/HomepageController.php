<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Hotel;
use App\Mail\SubscribeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HomepageController extends Controller
{
    public function index(){
        $totalHotels = Hotel::count();
        $topHotels = DB::table('rankings')
                        ->join('alternatives', 'rankings.alternative_id', '=', 'alternatives.id')
                        ->join('hotels', 'alternatives.hotel_id', '=', 'hotels.id')
                        ->orderByDesc('rankings.score')
                        ->limit(3)
                        ->get();
        return view('users.index', compact('topHotels','totalHotels'));
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        try {
            $name = $request->input('name');
            $email = $request->input('email');
            $message = $request->input('message');
            $toEmail = 'yosirifaiputra@gmail.com';

            Mail::to($toEmail)->send(new SubscribeEmail($name, $email, $message));

            Log::info('Mail sent successfully');
            return back()->with('success', 'Your feedback has been sent successfully!');
        } catch (Exception $e) {
            Log::error('Mail Error: '.$e->getMessage());
            return back()->with('error', 'Failed to send feedback. Please try again later.');
        }
    }
}
