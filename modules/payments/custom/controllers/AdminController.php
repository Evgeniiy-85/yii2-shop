<?php

namespace app\modules\payments\custom\controllers;

use app\models\Payment;
use app\modules\admin\models\Files;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;
use yii\web\HttpException;

/**
 * Default controller for the `admin` module
 */
class AdminController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin', 'manager']
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'actions' => ['admin/auth/logout'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['?'],
                        'matchCallback' => function ($rule, $action) {
                            return $this->redirect(['/admin/auth/login'])->send();
                        }
                    ]
                ]
            ]
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
        ];
    }

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action) {
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result){
        return parent::afterAction($action, $result);
    }


    /**
     * @return string|\yii\web\Response
     * @throws HttpException
     * @throws \yii\db\Exception
     */
    public function actionIndex() {
        $model = Payment::find()->where(['pay_name' => 'custom'])->one();
        $files = new Files();

        if (!$model) {
            throw new HttpException(404, "Страница не найдена.");
        }

        if ($post = Yii::$app->request->post('Payment')) {
            $model->load(Yii::$app->request->post());
            $model->save() ? $model->addSuccess('Успешно') : $model->addWarning('Ошибка при сохранении');
            return $this->redirect(['/admin/settings/payments']);
        }

        return $this->render('edit', [
            'model' => $model,
            'files' => $files,
        ]);
    }
}
