<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Ranking;
use App\Models\Alternative;
use Illuminate\Http\Request;

class HotelPageController extends Controller
{
    public function index(Request $request)
    {
        $totalHotels = Hotel::count();
        $sort_by = $request->get('sort_by');

        if (!$sort_by) {
            // Default sorting by rankings score
            $hotels = Hotel::select('hotels.*')
                ->join('alternatives', 'hotels.id', '=', 'alternatives.hotel_id')
                ->join('rankings', 'alternatives.id', '=', 'rankings.alternative_id')
                ->orderByDesc('rankings.score')
                ->with(['alternatives.rankings' => function($query) {
                    $query->orderByDesc('score');
                }])
                ->get();
        } else {
            switch ($sort_by) {
                case 'harga_asc':
                    $hotels = Hotel::select('hotels.*')
                        ->join('alternatives', 'hotels.id', '=', 'alternatives.hotel_id')
                        ->join('rankings', 'alternatives.id', '=', 'rankings.alternative_id')
                        ->orderBy('harga', 'asc')
                        ->orderByDesc('rankings.score')
                        ->with(['alternatives.rankings' => function($query) {
                            $query->orderByDesc('score');
                        }])
                        ->get();
                    break;
                case 'harga_desc':
                    $hotels = Hotel::select('hotels.*')
                        ->join('alternatives', 'hotels.id', '=', 'alternatives.hotel_id')
                        ->join('rankings', 'alternatives.id', '=', 'rankings.alternative_id')
                        ->orderBy('harga', 'desc')
                        ->orderByDesc('rankings.score')
                        ->with(['alternatives.rankings' => function($query) {
                            $query->orderByDesc('score');
                        }])
                        ->get();
                    break;
                case 'fasilitas_desc':
                    $hotels = Hotel::select('hotels.*')
                        ->join('alternatives', 'hotels.id', '=', 'alternatives.hotel_id')
                        ->join('rankings', 'alternatives.id', '=', 'rankings.alternative_id')
                        ->with(['alternatives.rankings' => function($query) {
                            $query->orderByDesc('score');
                        }])
                        ->get()
                        ->sortByDesc(function ($hotel) {
                            return count(json_decode($hotel->fasilitas));
                        });
                    break;
                case 'layanan_desc':
                    $hotels = Hotel::select('hotels.*')
                        ->join('alternatives', 'hotels.id', '=', 'alternatives.hotel_id')
                        ->join('rankings', 'alternatives.id', '=', 'rankings.alternative_id')
                        ->with(['alternatives.rankings' => function($query) {
                            $query->orderByDesc('score');
                        }])
                        ->get()
                        ->sortByDesc(function ($hotel) {
                            return count(json_decode($hotel->kualitas_layanan));
                        });
                    break;
                case 'rating_desc':
                    $hotels = Hotel::select('hotels.*')
                        ->join('alternatives', 'hotels.id', '=', 'alternatives.hotel_id')
                        ->join('rankings', 'alternatives.id', '=', 'rankings.alternative_id')
                        ->orderBy('rating', 'desc')
                        ->orderByDesc('rankings.score')
                        ->with(['alternatives.rankings' => function($query) {
                            $query->orderByDesc('score');
                        }])
                        ->get();
                    break;
                default:
                    $hotels = Hotel::select('hotels.*')
                        ->join('alternatives', 'hotels.id', '=', 'alternatives.hotel_id')
                        ->join('rankings', 'alternatives.id', '=', 'rankings.alternative_id')
                        ->orderByDesc('rankings.score')
                        ->with(['alternatives.rankings' => function($query) {
                            $query->orderByDesc('score');
                        }])
                        ->get();
                    break;
                }
            }

        return view('users.hotels', compact('hotels', 'totalHotels'));
    }

    public function about(Request $request){
        $totalHotels = Hotel::count();
        $hotels = Hotel::all();
        $selectedHotel = $request->get('hotel_id');
        $alternatives = [];
        $rankings = [];

        if ($selectedHotel) {
            $alternatives = Alternative::where('hotel_id', $selectedHotel)->get();
            $rankings = Ranking::whereHas('alternative', function ($query) use ($selectedHotel) {
                $query->where('hotel_id', $selectedHotel);
            })->get();
        }

        return view('users.about', compact('totalHotels', 'hotels', 'alternatives', 'rankings', 'selectedHotel'));
    }

    public function getHotelData($hotel_id)
    {
        $alternatives = Alternative::where('hotel_id', $hotel_id)->get(['c1', 'c2', 'c3', 'c4', 'c5', 'nilai']);
        $rankings = Ranking::whereHas('alternative', function ($query) use ($hotel_id) {
            $query->where('hotel_id', $hotel_id);
        })->get(['c1', 'c2', 'c3', 'c4', 'c5', 'score']);

        return response()->json([
            'alternatives' => $alternatives,
            'rankings' => $rankings,
        ]);
    }

    public function show($id)
    {
        $totalHotels = Hotel::count();
        $hotel = Hotel::findOrFail($id);
        return view('users.hotel-blog-detail', compact('hotel', 'totalHotels'));
    }
}
