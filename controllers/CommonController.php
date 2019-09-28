<?php


namespace app\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use Exception;

class CommonController extends Controller
{

    public function beforeAction($action)
    {

        try {
            $session = Yii::$app->getSession();
            $admin_id = $session->get('admin_id','');
            if (empty($admin_id)) {
                return $this->redirect('/site/login',302)->send();
            }
            return parent::beforeAction($action);
        } catch (Exception $e) {
            \Yii::$app->getResponse()->content = Json::encode(['code'=>99999,'msg'=>$e->getMessage()]);
            return \Yii::$app->getResponse()->send();
        }
    }

}