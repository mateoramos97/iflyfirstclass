<?php

namespace common\sys\core\landing;

use common\sys\repository\landing\AirlineRepository;

class AirlineInfoService
{
    private $airline_repo;
    private function get_airline_repo()
    {
        if($this->airline_repo != null)
            return $this->airline_repo;
        $this->airline_repo = new AirlineRepository();
        return $this->airline_repo;
    }

    public function get_airline_by_alias($alias)
    {
        return $this->get_airline_repo()->get_airline_by_alias($alias);
    }

    public function get_airline_by_id($id)
    {
        return $this->get_airline_repo()->get_airline_by_id($id);
    }

    public function get_airlines_list()
    {
        return $this->get_airline_repo()->get_airlines_list();
    }

    public function get_airline_images($continent_id)
    {
        return $this->get_airline_repo()->get_airline_images($continent_id);
    }

    public function AirlineDataProvider($params)
    {
        return $this->get_airline_repo()->AirlineDataProvider($params);
    }
}