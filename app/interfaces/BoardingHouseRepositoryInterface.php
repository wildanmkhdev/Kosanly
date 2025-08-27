<?php

namespace App\interfaces;

interface BoardingHouseRepositoryInterface
{
  public function getAllBoardingHouses($search = null, $city = null, $category = null);
  public function getPopularBoardingHouses($limit = 5);
  public function getBoardingHouseByCitySLug($slug);
  public function getBoardingHouseByCategorySLug($slug);
  public function getBoardingHouseBySLug($slug);
  public function getBoardingHouseRoomById($id);
}
