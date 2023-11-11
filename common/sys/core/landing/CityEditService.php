<?php

namespace common\sys\core\landing;


use common\sys\repository\landing\CityRepository;

class CityEditService
{
    private $city_repo;
    private function get_city_repo()
    {
        if($this->city_repo != null)
            return $this->city_repo;
        $this->city_repo = new CityRepository();
        return $this->city_repo;
    }

    public function add_item($params, $images)
    {
        return $this->get_city_repo()->add_item($params, $images);
    }

    public function update_item($params, $images)
    {
        return $this->get_city_repo()->update_item($params, $images);
    }

    public function delete_item($id)
    {
        return $this->get_city_repo()->delete_item($id);
    }
}