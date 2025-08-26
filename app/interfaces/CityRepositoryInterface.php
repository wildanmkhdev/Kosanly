<?php

namespace App\interfaces;

interface CityRepositoryInterface
{
  public function getAllCities();
  public function getCityBySLug($slug);
}
