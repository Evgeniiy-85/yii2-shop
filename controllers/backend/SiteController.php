<?php

namespace app\controllers\backend;

use app\models\LoginForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\ContactForm;

use Yii;

use yii\filters\VerbFilter;

use yii\web\Response;

class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }



    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
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
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'admin'],
                        //'roles' => ['Administrator']
                    ],
                ]
            ]
        ];
    }

    public function actionIndex() {
        return $this->render('/backend/index', [

        ]);
    }
    public function actionAdmin() {
        return $this->render('/backend/index', [

        ]);
    }

    public function actionError() {
        echo '!!!33';exit;
        return $this->render('/backend/index', [

        ]);
    }
}
