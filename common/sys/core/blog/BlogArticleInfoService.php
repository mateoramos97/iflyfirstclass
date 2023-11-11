<?php

namespace common\sys\core\blog;

use app\components\AppConfig;
use common\sys\repository\blog\BlogArticleRepository;
use yii;

class BlogArticleInfoService
{
    private $blog_article_repo;
    private function get_blog_article_repo()
    {
        if($this->blog_article_repo != null)
            return $this->blog_article_repo;
        $this->blog_article_repo = new BlogArticleRepository();
        return $this->blog_article_repo;
    }

    public function get_blog_article_by_alias($alias)
    {
        return $this->get_blog_article_repo()->get_blog_article_by_alias($alias);
    }

    public function get_blog_article_by_id($id)
    {
        return $this->get_blog_article_repo()->get_blog_article_by_id($id);
    }

    public function get_blog_images($blog_id)
    {
        return $this->get_blog_article_repo()->get_blog_images($blog_id);
    }

    public function get_all_blogs()
    {
        return $this->get_blog_article_repo()->get_all_blogs();
    }

    public function BlogListDataProvider($count)
    {
        return $this->get_blog_article_repo()->BlogListDataProvider($count);
    }

    public function BlogDataProvider($params)
    {
        return $this->get_blog_article_repo()->BlogDataProvider($params);
    }

    public function get_top_articles_in_list()
    {
        return $this->get_blog_article_repo()->get_top_articles_in_list();
    }
}