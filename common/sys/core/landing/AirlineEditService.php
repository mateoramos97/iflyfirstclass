<?php

namespace common\sys\core\landing;


use common\sys\repository\landing\AirlineRepository;

class AirlineEditService
{
    private $airline_repo;
    private function get_airline_repo()
    {
        if($this->airline_repo != null)
            return $this->airline_repo;
        $this->airline_repo = new AirlineRepository();
        return $this->airline_repo;
    }

    public function add_item($params, $images)
    {
        return $this->get_airline_repo()->add_item($params, $images);
    }

    public function update_item($params, $images)
    {
        return $this->get_airline_repo()->update_item($params, $images);
    }

    public function delete_item($id)
    {
        return $this->get_airline_repo()->delete_item($id);
    }
}