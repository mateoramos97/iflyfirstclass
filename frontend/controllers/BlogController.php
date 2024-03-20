<?php

namespace frontend\controllers;

use app\components\AppConfig;
use app\modules\imagemanager\models\Image;
use common\sys\core\seo\StaticPageInfoService;
use common\sys\repository\blog\models\BlogArticles;
use yii;
use common\sys\core\blog\BlogArticleInfoService;
use yii\web\HttpException;

class BlogController extends BaseController
{
    private $blog_info_service_repo;
    private function get_blog_info_service_repo()
    {
        if($this->blog_info_service_repo != null)
            return $this->blog_info_service_repo;
        $this->blog_info_service_repo = new BlogArticleInfoService();
        return $this->blog_info_service_repo;
    }

    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    // restrict access to
                    'Origin' => ['http://localhost:9900', 'http://iflyfirstclass:8080'],
                    'Access-Control-Request-Method' => ['POST', 'PUT'],
                    // Allow only POST and PUT methods
                    'Access-Control-Request-Headers' => ['X-Wsse'],
                    // Allow only headers 'X-Wsse'
                    'Access-Control-Allow-Credentials' => true,
                    // Allow OPTIONS caching
                    'Access-Control-Max-Age' => 3600,
                    // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                    'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
                ],

            ],
        ];
    }

    public function actionIndex()
    {
        $alias = Yii::$app->request->getQueryParam('alias');

        $blog_article = BlogArticles::find()
            ->where(['alias' => $alias])
            ->one();

        if(!$blog_article)
            throw new HttpException(404, 'Page not found');

        $images = Image::find()
            ->where([
                'content_id' => $blog_article->id,
                'content_type_id' => AppConfig::Image_ContentType_BlogArticle,
                'content_field_id' => AppConfig::Image_ContentField_BlogArticle,
            ])
            ->asArray()
            ->all();

        $this->bodyClass = "blog-article-page";
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $blog_article->description,
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $blog_article->keywords,
        ]);

        return $this->render('index', [
            'blog_article_model' => $blog_article,
            'images' => $images,
            'blog_articles' => $this->get_blog_info_service_repo()->BlogListDataProvider(11)->getModels(),
        ]);
    }

    public function actionList()
    {
        $this->bodyClass = "blog-page";
        $static_page_info_service = new StaticPageInfoService();
        $static_page = $static_page_info_service->get_static_page_by_id(AppConfig::Blog_Page);
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $static_page->description
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $static_page->keywords
        ]);

        $blog_articles = $this->get_blog_info_service_repo()->BlogListDataProvider(24);

        return $this->render('list', [
            'static_page' => $static_page,
            'blog_articles' => $blog_articles,
        ]);
    }

    public function actionListApi()
    {
        $this->bodyClass = "blog-page";
        $static_page_info_service = new StaticPageInfoService();
        $static_page = $static_page_info_service->get_static_page_by_id(AppConfig::Blog_Page);
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $static_page->description
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $static_page->keywords
        ]);

        $blog_articles = $this->get_blog_info_service_repo()->get_all_blogs();
        \Yii::$app->response->format = yii\web\Response::FORMAT_JSON;

        return $this->asJson($blog_articles);
    }
}