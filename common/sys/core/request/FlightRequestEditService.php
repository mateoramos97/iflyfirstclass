<?php

namespace common\sys\core\request;

use common\sys\repository\request\FlightRequestRepository;

class FlightRequestEditService
{
    private $flight_request_repo;
    private function get_flight_request_repo_repo()
    {
        if($this->flight_request_repo != null)
            return $this->flight_request_repo;
        $this->flight_request_repo = new FlightRequestRepository();
        return $this->flight_request_repo;
    }

    public function add_flight_request($params)
    {
        return $this->get_flight_request_repo_repo()->add_flight_request($params);
    }

    public function update_number_page_visits($request_number) {
        return $this->get_flight_request_repo_repo()->update_number_page_visits($request_number);
    }
}