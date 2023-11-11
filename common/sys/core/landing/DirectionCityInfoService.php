<?php

namespace common\sys\core\landing;


use common\sys\repository\landing\DirectionCityRepository;

class DirectionCityInfoService
{
    private $direction_city_repo;
    private function get_direction_city_repo()
    {
        if($this->direction_city_repo != null)
            return $this->direction_city_repo;
        $this->direction_city_repo = new DirectionCityRepository();
        return $this->direction_city_repo;
    }

    public function get_direction_city_by_alias($alias)
    {
        return $this->get_direction_city_repo()->get_direction_city_by_alias($alias);
    }

    public function get_direction_city_by_id($id)
    {
        return $this->get_direction_city_repo()->get_direction_city_by_id($id);
    }

    public function get_direction_city_images($continent_id)
    {
        return $this->get_direction_city_repo()->get_direction_city_images($continent_id);
    }

    public function get_direction_city_list()
    {
        return $this->get_direction_city_repo()->get_direction_city_list();
    }

    public function DirectionCityDataProvider($params)
    {
        return $this->get_direction_city_repo()->DirectionCityDataProvider($params);
    }
}