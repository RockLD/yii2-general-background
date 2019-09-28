<?php

namespace app\controllers;

use app\models\Admins;
use app\models\LoginRecords;
use app\services\Tools;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;

class SiteController extends Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
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
     * 管理员登录
     * @return array|string|void
     */
    public function actionLogin()
    {
        $admin_id = Yii::$app->getSession()->get('admin_id');
        if (!empty($admin_id)) {
            return $this->redirect('/')->send();
        }
        $req = Yii::$app->getRequest();
        if ($req->isAjax) {
            $ip = Tools::getRealIp();
            Yii::$app->getResponse()->format = Response::FORMAT_JSON;
            $uname = $req->post('uname');
            $pword = $req->post('pword');
            if (empty($uname) || empty($pword)) {
                LoginRecords::add($uname,$ip,'缺少用户名或密码');
                return ['code'=>40004,'msg'=>'请输入用户名或密码！'];
            }
            $adminInfo = Admins::getInfoByAccount($uname);
            if (empty($adminInfo)) {
                LoginRecords::add($uname,$ip,'账号错误');
                return ['code'=>40004,'msg'=>'账号错误！'];
            }
            if ($adminInfo['status'] != '正常') {
                LoginRecords::add($uname,$ip,$adminInfo['status'].'状态登录');
                return ['code'=>40004,'msg'=>'账号状态异常，请联系管理员！'];
            }
            if (md5($pword) != $adminInfo['password']) {
                LoginRecords::add($uname,$ip,'密码错误');
                return ['code'=>40004,'msg'=>'密码错误！'];
            }
            $session = Yii::$app->getSession();
            $session->setTimeout(1800);
            $session->set('admin_id',$adminInfo['admin_id']);
            $session->set('account',$adminInfo['account']);
            $session->set('role_id',$adminInfo['role_id']);
            $session->set('nickname',$adminInfo['nickname']);
            LoginRecords::add($uname,$ip,'success');
            return ['code'=>0,'msg'=>'登录成功！','data'=>[
                    'nickname'=>$adminInfo['nickname']
                ]
            ];
        }
        return $this->render('login');
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
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
