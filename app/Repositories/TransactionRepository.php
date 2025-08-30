<?php

namespace App\Repositories;

use App\interfaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
  public function getTransactionDataFromSession()
  {
    return session()->get('transaction');
    // ambil data dari data sementara yaitu session dengan key trsansation
  }
  public function saveTransactionDataToSession($data)
  {
    $transaction = session()->get('transaction', []);
    // ambil data masukkan ke dalam variable trsansaction klok gdk buat array kosong
    foreach ($data as $key => $value) {
      $transaction[$key] = $value;
    }
    //looping sema data baru menjadi 1 kesatuan data array
    session()->put('transaction', $transaction);
    // setelah itu data hasil dari array terbaru simpan lagi ke dalam sesseion
  }
}
