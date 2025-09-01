<?php

namespace App\Http\Controllers;

use App\Http\Requests\CostumerInformationStoreRequest;
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
        // 1. Ambil semua data input dari form booking
        //    Contoh hasilnya: ['name' => 'Wildan', 'phone' => '0812', 'room_id' => 3]
        //    lalu kirim ke Repository supaya disimpan sementara di session
        $this->transactionRepository->saveTransactionDataToSession($request->all());
        // 2. Setelah data disimpan di session,
        //    user langsung diarahkan (redirect) ke halaman berikutnya
        //    yaitu route 'booking.information' sambil bawa slug (nama unik kos/produk)
        return redirect()->route('booking.information', $slug);
    }
    public function information(Request $request, $slug)
    {
        // 1. Ambil kembali data transaksi yang sebelumnya sudah disimpan di session
        $transaction = $this->transactionRepository->getTransactionDataFromSession();
        // 2. Ambil data kos (boarding house) berdasarkan slug yang dikirim dari URL
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySLug($slug);
        // 3. Ambil data kamar berdasarkan id kamar yang dikirim lewat query string
        $room = $this->boardingHouseRepository->getBoardingHouseRoomById($transaction['room_id']);
        if (empty($transaction['start_date'])) {
            $transaction['start_date'] = now()->format('Y-m-d'); // tanggal hari ini
            $this->transactionRepository->saveTransactionDataToSession($transaction);
        }


        return view('pages.booking.information', compact('transaction', 'boardingHouse', 'room'));
    }
    public function saveInformation(CostumerInformationStoreRequest $request, $slug)
    {
        // 1. Validasi data form yang dikirim user sesuai aturan di CostumerInformationStoreRequest
        //    Jadi cuma data yang valid aja yang boleh masuk.
        $data = $request->validated();
        // 2. Simpan data hasil validasi tadi ke session (menambah / mengupdate transaction)
        $this->transactionRepository->saveTransactionDataToSession($data);
        // dd($this->transactionRepository->getTransactionDataFromSession());
        return redirect()->route('booking.checkout', $slug);
    }
    public function checkout($slug)
    {
        $transaction = $this->transactionRepository->getTransactionDataFromSession();
        // 2. Ambil data kos (boarding house) berdasarkan slug yang dikirim dari URL
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySLug($slug);
        // 3. Ambil data kamar berdasarkan id kamar yang dikirim lewat query string
        $room = $this->boardingHouseRepository->getBoardingHouseRoomById($transaction['room_id']);
        return view('pages.booking.checkout', compact('transaction', 'boardingHouse', 'room'));
    }
}
