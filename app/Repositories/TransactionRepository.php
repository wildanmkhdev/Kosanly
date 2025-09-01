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
    if (is_array($data)) {
      foreach ($data as $key => $value) {
        $transaction[$key] = $value;
      }
    }
    session()->put('transaction', $transaction);
  }
}
