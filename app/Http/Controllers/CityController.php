<?php

namespace App\Http\Controllers;

use App\interfaces\BoardingHouseRepositoryInterface;
use App\interfaces\CityRepositoryInterface;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private BoardingHouseRepositoryInterface $boardingHouseRepository;
    private CityRepositoryInterface $cityRepository;
    public function __construct(BoardingHouseRepositoryInterface $boardingHouseRepository, CityRepositoryInterface $categoryRepository)
    {

        $this->boardingHouseRepository = $boardingHouseRepository;
        $this->cityRepository = $categoryRepository;
    }
    public function show($slug)
    {
        $boardingHouses = $this->boardingHouseRepository->getBoardingHouseByCitySlug($slug);
        $city = $this->cityRepository->getCityBySlug($slug);
        return view('pages.city.show', compact('boardingHouses', 'city'));
    }
}
