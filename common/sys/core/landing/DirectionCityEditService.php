<?php

namespace common\sys\core\landing;


use common\sys\repository\landing\DirectionCityRepository;

class DirectionCityEditService
{
    private $direction_city_repo;
    private function get_direction_city_repo()
    {
        if($this->direction_city_repo != null)
            return $this->direction_city_repo;
        $this->direction_city_repo = new DirectionCityRepository();
        return $this->direction_city_repo;
    }

    public function add_item($params, $images)
    {
        return $this->get_direction_city_repo()->add_item($params, $images);
    }

    public function update_item($params, $images)
    {
        return $this->get_direction_city_repo()->update_item($params, $images);
    }

    public function delete_item($id)
    {
        return $this->get_direction_city_repo()->delete_item($id);
    }
}