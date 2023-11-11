<?php

namespace common\sys\core\request;

use app\components\AppConfig;
use common\sys\repository\request\FlightRequestRepository;

class FlightRequestInfoService
{
    private $flight_request_repo;
    private function get_flight_request_repo_repo()
    {
        if($this->flight_request_repo != null)
            return $this->flight_request_repo;
        $this->flight_request_repo = new FlightRequestRepository();
        return $this->flight_request_repo;
    }

    public function GetTrips($params)
    {
        $trips = array();
        foreach($params['from'] as $key => $item) {
            $trips[$key]['from'] = $item;
            $trips[$key]['to'] = $params['to'][$key];
            $trips[$key]['dep_date'] = $params['dep_date'][$key];
            if($params['type_trip'] == AppConfig::Type_Trip_Round_Trip) {
                $trips[$key]['arr_date'] = $params['arr_date'][$key];
            }
            else {
                $trips[$key]['arr_date'] = null;
            }
        }

        return $trips;
    }

    public function get_request_form_user_by_id($id)
    {
        return $this->get_flight_request_repo_repo()->get_request_form_user_by_id($id);
    }

    public function get_request_form_user_by_request_number($request_number)
    {
        return $this->get_flight_request_repo_repo()->get_request_form_user_by_request_number($request_number);
    }

    public function get_request_form_user_info_by_request_form_id($request_form_id)
    {
        return $this->get_flight_request_repo_repo()->get_request_form_user_info_by_request_form_id($request_form_id);
    }

    public function get_request_form_user_emails()
    {
        return $this->get_flight_request_repo_repo()->get_request_form_user_emails();
    }

    public function RequestFlightDataProvider($params)
    {
        return $this->get_flight_request_repo_repo()->RequestFlightDataProvider($params);
    }
}