<?php
namespace app\modules\admin\controllers;

use app\models\Users;
use Yii;
use yii\web\Controller;
use app\modules\admin\models\LoginForm;
use yii\web\HttpException;

class AuthController extends Controller {

    public function actionLogin() {
        $this->layout = 'main-login';
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                return $this->redirect('/admin');
            }

            return $this->refresh();
        }

        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout() {
        LoginForm::logout();
        return $this->redirect('/admin/auth/login');
    }
}