<?php

namespace common\sys\core\landing;

use common\sys\repository\landing\CityRepository;

class CityInfoService
{
    private $city_repo;
    private function get_city_repo()
    {
        if($this->city_repo != null)
            return $this->city_repo;
        $this->city_repo = new CityRepository();
        return $this->city_repo;
    }

    public function get_city_by_alias($alias)
    {
        return $this->get_city_repo()->get_city_by_alias($alias);
    }

    public function get_city_by_id($id)
    {
        return $this->get_city_repo()->get_city_by_id($id);
    }

    public function get_cities_list() {
        return $this->get_city_repo()->get_cities_list();
    }

    public function get_city_images($city_id)
    {
        return $this->get_city_repo()->get_city_images($city_id);
    }

    public function get_random_cities($count = "")
    {
        return $this->get_city_repo()->get_random_cities($count);
    }

    public function get_cities_info_by_continent_id($continent_id)
    {
        return $this->get_city_repo()->get_cities_info_by_continent_id($continent_id);
    }

    public function CityDataProvider($params)
    {
        return $this->get_city_repo()->CityDataProvider($params);
    }
}