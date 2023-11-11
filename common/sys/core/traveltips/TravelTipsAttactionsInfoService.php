<?php

namespace common\sys\core\traveltips;

use common\sys\repository\traveltips\TravelTipsAttactionsRepository;

class TravelTipsAttactionsInfoService
{
    private $travel_tips_attactions_repo;
    private function get_travel_tips_attactions_repo()
    {
        if($this->travel_tips_attactions_repo != null)
            return $this->travel_tips_attactions_repo;
        $this->travel_tips_attactions_repo = new TravelTipsAttactionsRepository();
        return $this->travel_tips_attactions_repo;
    }

    public function get_travel_tips_attctions_by_travel_tip_id($travel_tip_id)
    {
        return $this->get_travel_tips_attactions_repo()->get_travel_tips_attctions_by_travel_tip_id($travel_tip_id);
    }

    public function get_travel_tip_attaction_by_id($id)
    {
        return $this->get_travel_tips_attactions_repo()->get_travel_tip_attaction_by_id($id);
    }

    public function get_travel_tip_attaction_images($id)
    {
        return $this->get_travel_tips_attactions_repo()->get_travel_tip_attaction_images($id);
    }
}