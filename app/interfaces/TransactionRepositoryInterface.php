<?php

namespace App\interfaces;

interface  TransactionRepositoryInterface
{

  public function getTransactionDataFromSection();
  public function saveTransactionDataToSession($data);
}
