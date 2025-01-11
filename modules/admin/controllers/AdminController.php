<?php

namespace app\modules\admin\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;
/**
 * Default controller for the `admin` module
 */
class AdminController extends Controller
{

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action) {
        $session = Yii::$app->session;
        $session->open();

        if (!$session->has('auth_site_admin')) {
            $this->redirect('/admin/auth/login');
            return false;
        }

        return parent::beforeAction($action);
    }


    /**
     * @return array[]
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
