<?php

namespace common\sys\core\subscribers;

use common\sys\repository\subscribers\SubscribersRepository;

class SubscribersArticleEditService
{
    private $subscribers_article_repo;
    private function get_subscribers_article_repo()
    {
        if($this->subscribers_article_repo != null)
            return $this->subscribers_article_repo;
        $this->subscribers_article_repo = new SubscribersRepository();
        return $this->subscribers_article_repo;
    }

    public function add_item($params)
    {
        return $this->get_subscribers_article_repo()->add_item($params);
    }
}