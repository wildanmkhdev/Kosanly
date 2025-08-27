<?php

namespace App\Repositories;

use App\interfaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
  public function getTransactionDataFromSection()
  {
    return session()->get('/transaction');
  }
  public function saveTransactionDataToSession($data)
  {
    $trsansaction = session()->get('/transaction', []);
    foreach ($data as $key => $value) {
      $trsansaction[$key] = $value;
    }
    session()->put('transaction', $trsansaction);
  }
}
