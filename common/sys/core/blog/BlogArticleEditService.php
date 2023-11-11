<?php

namespace common\sys\core\blog;

use common\sys\repository\blog\BlogArticleRepository;

class BlogArticleEditService
{
    private $blog_article_repo;
    private function get_blog_article_repo()
    {
        if($this->blog_article_repo != null)
            return $this->blog_article_repo;
        $this->blog_article_repo = new BlogArticleRepository();
        return $this->blog_article_repo;
    }

    public function add_blog_article($params, $images)
    {
        return $this->get_blog_article_repo()->add_blog_article($params, $images);
    }

    public function update_blog_article($params, $images)
    {
        return $this->get_blog_article_repo()->update_blog_article($params, $images);
    }

    public function delete_item($id)
    {
        return $this->get_blog_article_repo()->delete_item($id);
    }
}