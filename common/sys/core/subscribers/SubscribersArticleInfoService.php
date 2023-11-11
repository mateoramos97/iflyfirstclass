<?php

namespace common\sys\core\subscribers;

use common\sys\repository\subscribers\SubscribersRepository;

class SubscribersArticleInfoService
{
    private $subscribers_article_repo;
    private function get_subscribers_article_repo()
    {
        if($this->subscribers_article_repo != null)
            return $this->subscribers_article_repo;
        $this->subscribers_article_repo = new SubscribersRepository();
        return $this->subscribers_article_repo;
    }

    public function get_subscribers()
    {
        return $this->get_subscribers_article_repo()->get_subscribers();
    }

    public function get_subscriber_by_email($email)
    {
        return $this->get_subscribers_article_repo()->get_subscriber_by_email($email);
    }
}