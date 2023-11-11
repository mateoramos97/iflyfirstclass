<?php

namespace common\sys\core\seo;

use common\sys\repository\seo\StaticPageRepository;

class StaticPageEditService
{
    private $static_page_repo;
    private function get_static_page_repo()
    {
        if($this->static_page_repo != null)
            return $this->static_page_repo;
        $this->static_page_repo = new StaticPageRepository();
        return $this->static_page_repo;
    }

    public function update_static_page($params)
    {
        return $this->get_static_page_repo()->update_static_page($params);
    }
}