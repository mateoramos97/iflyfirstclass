<?php

namespace common\sys\core\traveltips;

use common\sys\repository\traveltips\TravelTipsRepository;

class TravelTipsEditService
{
    private $travel_tips_repo;
    private function get_travel_tips_repo()
    {
        if($this->travel_tips_repo != null)
            return $this->travel_tips_repo;
        $this->travel_tips_repo = new TravelTipsRepository();
        return $this->travel_tips_repo;
    }

    public function add_item($params, $images)
    {
        return $this->get_travel_tips_repo()->add_item($params, $images);
    }

    public function update_item($params, $images)
    {
        return $this->get_travel_tips_repo()->update_item($params, $images);
    }

    public function delete_item($id)
    {
        return $this->get_travel_tips_repo()->delete_item($id);
    }
}