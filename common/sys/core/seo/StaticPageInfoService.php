<?php

namespace common\sys\core\seo;

use common\sys\repository\seo\StaticPageRepository;

class StaticPageInfoService
{
    private $static_page_repo;
    private function get_static_page_repo()
    {
        if($this->static_page_repo != null)
            return $this->static_page_repo;
        $this->static_page_repo = new StaticPageRepository();
        return $this->static_page_repo;
    }

    public function get_static_pages()
    {
        return $this->get_static_page_repo()->get_static_pages();
    }

    public function get_static_page_by_id($id)
    {
        return $this->get_static_page_repo()->get_static_page_by_id($id);
    }
}