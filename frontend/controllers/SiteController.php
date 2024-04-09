<?php
namespace frontend\controllers;

use app\components\AppConfig;
use common\sys\core\landing\CityInfoService;
use common\sys\core\landing\CountryInfoService;
use common\sys\core\landing\ContinentInfoService;
use common\sys\core\landing\AirlineInfoService;
use common\sys\core\blog\BlogArticleInfoService;
use common\sys\core\testimonials\TestimonialsInfoService;
use common\sys\core\traveltips\TravelTipsInfoService;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\sys\core\seo\StaticPageInfoService;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->bodyClass = "front-page";
        $static_page_info_service = new StaticPageInfoService();
        $country_info_service = new CountryInfoService();
        $city_info_service = new CityInfoService();
        $airline_info_service = new AirlineInfoService();
        $blog_info_service = new BlogArticleInfoService();
        $travel_tips_info_service = new TravelTipsInfoService();
        $testimonialsService = new TestimonialsInfoService();

        $static_page = $static_page_info_service->get_static_page_by_id(AppConfig::Home_Page);
        $random_cities = $city_info_service->get_random_cities(16);
        $countries = $country_info_service->get_countries_list();
        $cities = $city_info_service->get_cities_list();
        $airlines = $airline_info_service->get_airlines_list();
        $top_articles_in_list = $blog_info_service->get_top_articles_in_list_with_images();

        if (!$travel_tips = Yii::$app->cache->get('travel_tips')) {
            $travel_tips = $travel_tips_info_service->random_travel_tips(4);
            Yii::$app->cache->set('travel_tips', $travel_tips, 60*60*72); // cache 72 hours
        }

        // Yii::$app->cache->delete('random_travel_tips'); //delete cache
        if (!$random_travel_tips = Yii::$app->cache->get('random_travel_tips')) {
            $random_travel_tips = $travel_tips_info_service->random_travel_tips(1);
            Yii::$app->cache->set('random_travel_tips', $random_travel_tips, 60*60*72); // cache 72 hours
        }

        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $static_page->description
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $static_page->keywords
        ]);

        $articles = [];
        for($i = 0; $i <= count($top_articles_in_list)-1; $i++)
        {
            $articles[2*$i] = $top_articles_in_list[$i];
            if (isset($travel_tips[$i])) {
                $articles[2*$i+1] = $travel_tips[$i];
            }
        }

        return $this->render('index', [
            'head_title' => $static_page->title,
            'random_cities' => array_chunk($random_cities, 8),
            'countries' => $countries,
            'cities' => $cities,
            'airlines' => $airlines,
            'top_articles_in_list' => $articles,
            'travel_tips' => $travel_tips,
            'random_travel_tips' => $random_travel_tips,
            'reviews' => $testimonialsService->get_testimonials_is_top(15),
        ]);
    }

    public function actionCities()
    {
        $citi_info_service = new CityInfoService();
        $cities_random = $citi_info_service->get_random_cities(20);

        return $this->renderAjax('_cities', ['cities_random' => $cities_random]);
    }

    public function actionContinents()
    {
        $continent_info_service = new ContinentInfoService();
        $citi_info_service = new CityInfoService();
        $continents = $continent_info_service->select_continent_to_form();
        foreach($continents as $key => &$item)
        {
            $item['cities'] = $citi_info_service->get_cities_info_by_continent_id($item['id']);
        }

        return $this->renderAjax('_continents', ['continents' => $continents]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->bodyClass = "login-page";
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
