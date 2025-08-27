<?php

namespace App\Http\Controllers;

use App\interfaces\BoardingHouseRepositoryInterface;
use App\interfaces\TransactionRepositoryInterface;
use Illuminate\Http\Request;

class BookingController extends Controller

{
    private BoardingHouseRepositoryInterface $boardingHouseRepository;
    private TransactionRepositoryInterface $transactionRepository;
    public function __construct(BoardingHouseRepositoryInterface $boardingHouseRepository, TransactionRepositoryInterface $transactionRepository)
    {
        $this->boardingHouseRepository = $boardingHouseRepository;
        $this->transactionRepository = $transactionRepository;
    }
    public function check()
    {
        return view('pages.check-booking');
    }
    public function booking(Request $request, $slug)
    {
        $this->transactionRepository->saveTransactionDataToSession($request->all());
        return redirect()->route('booking.information', $slug);
    }
    public function informations($slug)
    {
        $transaction = $this->transactionRepository->getTransactionDataFromSection();
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySLug($slug);
        $room = $this->boardingHouseRepository->getBoardingHouseRoomById($transaction['room_id'] ?? null);
        return view('pages.booking.information', compact('transaction', 'boardingHouse', 'room'));
    }
}
