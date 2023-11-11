<?php

namespace common\sys\core\traveltips;

use common\sys\repository\traveltips\TravelTipsRepository;

class TravelTipsInfoService
{
    private $travel_tips_repo;
    private function get_travel_tips_repo()
    {
        if($this->travel_tips_repo != null)
            return $this->travel_tips_repo;
        $this->travel_tips_repo = new TravelTipsRepository();
        return $this->travel_tips_repo;
    }

    public function get_travel_tip_by_alias($alias)
    {
        return $this->get_travel_tips_repo()->get_travel_tip_by_alias($alias);
    }

    public function get_travel_tip_by_id($id)
    {
        return $this->get_travel_tips_repo()->get_travel_tip_by_id($id);
    }

    public function get_travel_tip_images($travel_tip_id)
    {
        return $this->get_travel_tips_repo()->get_travel_tip_images($travel_tip_id);
    }

    public function random_travel_tips($count)
    {
        return $this->get_travel_tips_repo()->random_travel_tips($count);
    }

    public function TravelTipsListDataProvider($pageSize)
    {
        return $this->get_travel_tips_repo()->TravelTipsListDataProvider($pageSize);
    }

    public function TravelTipsDataProvider($params)
    {
        return $this->get_travel_tips_repo()->TravelTipsDataProvider($params);
    }
}