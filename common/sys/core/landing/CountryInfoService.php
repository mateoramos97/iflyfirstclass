<?php

namespace common\sys\core\landing;


use common\sys\repository\landing\CountryRepository;

class CountryInfoService
{
    private $country_repo;
    private function get_country_repo()
    {
        if($this->country_repo != null)
            return $this->country_repo;
        $this->country_repo = new CountryRepository();
        return $this->country_repo;
    }

    public function get_country_by_alias($alias)
    {
        return $this->get_country_repo()->get_country_by_alias($alias);
    }

    public function get_country_by_id($id)
    {
        return $this->get_country_repo()->get_country_by_id($id);
    }

    public function get_country_images($continent_id)
    {
        return $this->get_country_repo()->get_country_images($continent_id);
    }

    public function select_country_to_form()
    {
        return $this->get_country_repo()->select_country_to_form();
    }

    public function get_countries_list()
    {
        return $this->get_country_repo()->get_countries_list();
    }

    public function get_random_country($limit) {
        return $this->get_country_repo()->get_random_country($limit);
    }

    public function CountryDataProvider($params)
    {
        return $this->get_country_repo()->CountryDataProvider($params);
    }
}