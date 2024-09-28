<?php

namespace app\controllers;

use app\models\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
{
    // Redirect to home if the user is already logged in
    if (!Yii::$app->user->isGuest) {
        return $this->goHome();
    }

    // Create a new instance of the LoginForm model
    $model = new LoginForm();

    // Load the form data and attempt to log in
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
        return $this->goBack();
    }

    // Check if the user is not registered
    if (User::find()->where(['username' => $model->username])->exists() && $model->username) {
        Yii::$app->session->setFlash('error', 'User not registered.');
    }

    if (!User::find()->where(['username' => $model->username])->exists() && $model->username) {
        Yii::$app->session->setFlash('error', 'User not registered.');
        Yii::debug('User not registered flash message set');
    }

    if ($model->username && !User::find()->where(['username' => $model->username])->exists()) {
        Yii::debug('Setting flash message: User not registered');
        Yii::$app->session->setFlash('error', 'User not registered.');
    }
    

    // Clear the password field for security
    $model->password = '';

    // Render the login view
    return $this->render('login', [
        'model' => $model,
    ]);
}

    public function actionSignup() 
    {
       $model = new SignupForm();
       if ($model->load(Yii::$app->request->post()) && $model->signup()) {
        return $this->goHome();
       }
        return $this->render('signup', [
            'model'=> $model,
        ] );
    
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays article page.
     *
     * @return string
     */
    public function actionArticle()
    {
        return $this->render('Articles');
    }
}
