<?php

namespace App\Repositories;

use App\interfaces\BoardingHouseRepositoryInterface;
use App\Models\BoardingHouse;
use App\Models\Room;
use Illuminate\Database\Eloquent\Builder;

class BoardingHouseRepository implements BoardingHouseRepositoryInterface
{
  public function getAllBoardingHouses($search = null, $city = null, $category = null)
  // $search dll dapat  inputan dari controller $request->serach yg dapat data dari name form
  {
    $query = BoardingHouse::query(); //untuk memulai query kosong
    if ($search) {
      // jika data search ny ada jalan kan query nya select all
      $query->where('name', 'like', '%' . $search . '%');
    }
    if ($city) {
      $query->whereHas('city', function (Builder $query) use ($city) {
        $query->where('slug', $city);
      });
    }
    if ($category) {
      $query->whereHas('category', function (Builder $query) use ($category) {
        $query->where('slug', $category);
      });
    }
    return $query->get();
  }

  public function getPopularBoardingHouses($limit = 5)
  {
    return BoardingHouse::withCount('transactions')->orderBy('transactions_count', 'desc')->take($limit)->get();
    // ambil data dari boarding house tambahkan kolom transaction_count dari withcount yg menghitung ad berapa jumlah transations misal 10 terus order by di urutkan berdasarkan desc klom transaction ambil berdasarkan limit = 5 data saja yg nanti data nya berupa array dengan data baru transactions_count
    // withCount('transactions') fungsi inilah yg buat data baru bernama transaction_count
  }

  public function getBoardingHouseByCitySLug($slug)
  // slug di sini adlah paramter dari route '/kos/{slug}' nah slug itu nanti di view akan di echokan melalu $boardingHouse->slug nah jadi slug bernilai contoh {slug} = $slug =  (kos-nenek)
  {
    return BoardingHouse::wherehas('city', function (Builder $query) use ($slug) {
      $query->where('slug', $slug);
    })->get();
  }
  public function getBoardingHouseByCategorySLug($slug)
  {
    return BoardingHouse::wherehas('category', function (Builder $query) use ($slug) {
      $query->where('slug', $slug);
    })->get();
    //ambil data Boardinghouse yg punya category tertenntu yg diman akategori tertentu itu di ambil dari slug kriterianya
  }

  public function getBoardingHouseBySlug($slug)
  {
    return BoardingHouse::with('rooms.images')->where('slug', $slug)->first();
    //kembalikan data dari model boardinghouse dengan relasi tabel room dan relasi  image di dalamnya  yg klom slug nya = $slug dari paramter ambil lalu ambil  data pertama
  }
  public function getBoardingHouseRoomById($id)
  {
    return Room::find($id);
  }
}
