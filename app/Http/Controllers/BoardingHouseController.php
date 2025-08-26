<?php

namespace App\Http\Controllers;

use App\interfaces\BoardingHouseRepositoryInterface;
use App\interfaces\CategoryRepositoryInterface;
use App\interfaces\CityRepositoryInterface;
use Illuminate\Http\Request;

class BoardingHouseController extends Controller
{
    private CityRepositoryInterface $cityRepository;
    private CategoryRepositoryInterface $categoryRepository;
    private BoardingHouseRepositoryInterface $boardingHouseRepository;
    public function __construct(CityRepositoryInterface $cityRepository, CategoryRepositoryInterface $categoryRepository, BoardingHouseRepositoryInterface $boardingHouseRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->categoryRepository = $categoryRepository;
        $this->boardingHouseRepository = $boardingHouseRepository;
    }
    //
    public function find()

    {
        $categories = $this->categoryRepository->getAllCategories();
        $cities = $this->cityRepository->getAllCities();
        return view('pages.boarding-house.find', compact('cities', 'categories'));
    }
}
