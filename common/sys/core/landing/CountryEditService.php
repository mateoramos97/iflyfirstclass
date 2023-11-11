<?php

namespace common\sys\core\landing;

use common\sys\repository\landing\CountryRepository;

class CountryEditService
{
    private $country_repo;
    private function get_country_repo()
    {
        if($this->country_repo != null)
            return $this->country_repo;
        $this->country_repo = new CountryRepository();
        return $this->country_repo;
    }

    public function add_item($params, $images)
    {
        return $this->get_country_repo()->add_item($params, $images);
    }

    public function update_item($params, $images)
    {
        return $this->get_country_repo()->update_item($params, $images);
    }

    public function delete_item($id)
    {
        return $this->get_country_repo()->delete_item($id);
    }
}