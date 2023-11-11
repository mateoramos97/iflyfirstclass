<?php

namespace common\sys\core\landing;


use common\sys\repository\landing\ContinentRepository;

class ContinentEditService
{
    private $continent_repo;
    private function get_continent_repo()
    {
        if($this->continent_repo != null)
            return $this->continent_repo;
        $this->continent_repo = new ContinentRepository();
        return $this->continent_repo;
    }

    public function add_continent($params, $images)
    {
        return $this->get_continent_repo()->add_continent($params, $images);
    }

    public function update_continent($params, $images)
    {
        return $this->get_continent_repo()->update_continent($params, $images);
    }

    public function delete_item($id)
    {
        return $this->get_continent_repo()->delete_item($id);
    }
}