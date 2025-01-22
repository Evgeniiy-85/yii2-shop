<?php
namespace app\modules\admin\controllers;

use app\models\User;
use Yii;
use yii\web\Controller;
use app\modules\admin\models\LoginForm;
use yii\web\HttpException;

class AuthController extends Controller {

    public function actionLogin() {
        $this->layout = 'main-login';
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/admin');
        }

        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect('/admin/auth/login');
    }
}