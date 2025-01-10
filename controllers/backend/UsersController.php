<?php

namespace app\controllers\backend;

use app\models\LoginForm;
use Yii;
use yii\web\Controller;

class UsersController extends Controller {

    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->actionLogin();
        }
    }

    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goBack();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            return $this->goBack();
        }

        $model->password = '';
        return $this->render('/backend/users/login', [
            'model' => $model,
        ]);
    }
}