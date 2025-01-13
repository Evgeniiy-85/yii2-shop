<?php
namespace app\modules\admin\controllers;

use app\models\Users;
use Yii;
use yii\web\Controller;
use app\modules\admin\models\LoginForm;

class AuthController extends Controller {

    public function actionLogin() {
        $this->layout = 'main-login';
        $model = new LoginForm();
        if ($model->load($post = Yii::$app->request->post()) && $model->validate()) {
            $user = Users::find()->where(['user_email' => $model->email])->one();
            if (!$user || !password_verify($model->password, $user['user_password_hash'])) {
                return $this->refresh();
            }

            LoginForm::login();
            return $this->redirect('/admin');
        }

        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout() {
        LoginForm::logout();
        return $this->redirect('/admin/auth/login');
    }
}