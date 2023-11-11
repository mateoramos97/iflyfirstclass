<?php

namespace common\sys\core\sitemappage;

use common\sys\repository\sitemappage\SiteMapPageRepository;

class SiteMapPageInfoService
{
    private $site_map_article_repo;
    private function get_site_map_article_repo()
    {
        if($this->site_map_article_repo != null)
            return $this->site_map_article_repo;
        $this->site_map_article_repo = new SiteMapPageRepository();
        return $this->site_map_article_repo;
    }

    public function get_site_map($pageSize)
    {
        return $this->get_site_map_article_repo()->get_site_map($pageSize);
    }
}