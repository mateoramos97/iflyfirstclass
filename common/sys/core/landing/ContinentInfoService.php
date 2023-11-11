<?php

namespace common\sys\core\landing;

use common\sys\repository\landing\ContinentRepository;

class ContinentInfoService
{
    private $continent_repo;
    private function get_continent_repo()
    {
        if($this->continent_repo != null)
            return $this->continent_repo;
        $this->continent_repo = new ContinentRepository();
        return $this->continent_repo;
    }

    public function get_continent_by_alias($alias)
    {
        return $this->get_continent_repo()->get_continent_by_alias($alias);
    }

    public function get_continent_by_id($id)
    {
        return $this->get_continent_repo()->get_continent_by_id($id);
    }

    public function get_continent_images($continent_id)
    {
        return $this->get_continent_repo()->get_continent_images($continent_id);
    }

    public function select_continent_to_form()
    {
        return $this->get_continent_repo()->select_continent_to_form();
    }

    public function ContinentDataProvider($params)
    {
        return $this->get_continent_repo()->ContinentDataProvider($params);
    }
}