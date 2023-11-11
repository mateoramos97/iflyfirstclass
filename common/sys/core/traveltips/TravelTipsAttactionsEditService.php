<?php

namespace common\sys\core\traveltips;

use common\sys\repository\traveltips\TravelTipsAttactionsRepository;

class TravelTipsAttactionsEditService
{
    private $travel_tips_attactions_repo;
    private function get_travel_tips_attactions_repo()
    {
        if($this->travel_tips_attactions_repo != null)
            return $this->travel_tips_attactions_repo;
        $this->travel_tips_attactions_repo = new TravelTipsAttactionsRepository();
        return $this->travel_tips_attactions_repo;
    }

    public function add_item($params, $images)
    {
        return $this->get_travel_tips_attactions_repo()->add_item($params, $images);
    }
    public function update_item($params, $images)
    {
        return $this->get_travel_tips_attactions_repo()->update_item($params, $images);
    }

    public function delete_item($id)
    {
        return $this->get_travel_tips_attactions_repo()->delete_item($id);
    }
}