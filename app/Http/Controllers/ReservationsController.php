<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Product;
use Illuminate\Support\Arr; 
class ReservationsController extends Controller
{
    public function getReservations(Request $request)
    {
        $reservations = Reservation::all();
        $reservations->map(function($reservation){
            $reservation = Arr::add($reservation, 'product', $reservation->product);
            return $reservation;
        });
        return $reservations;
    }
    public function makeReservation(Request $request)
    {
        $reservation = Reservation::create([
            'dateFrom'=>$request->dateFrom,
            'dateTo'=>$request->dateTo,
            'status'=>$request->status,
        ]);
        $product = Product::where('id', $request->productId)->first();
        $product->availability = false;
        $product->save();
        $reservation->product()->save($product);
        return $reservation;
    }
    public function deleteReservation(Request $request)
    {
        $reservation = Reservation::findOrFail($request->id);
        $product = $reservation->product;
        $product->availability = true;
        $product->save();
        $reservation->delete();
    }
}