<?php

namespace app\modules\admin\controllers;

use app\models\LoginForm;
use app\models\Products;
use app\models\Users;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\HttpException;

class UsersController extends Controller {

    public function actionIndex() {
        $pageSize = 36;

        $query = Users::find();
        $pages = new Pagination([
            'pageSize' => $pageSize,
            'defaultPageSize' => $pageSize,
            'totalCount' => $query->count()
        ]);

        $query
            ->orderBy(['user_id' => SORT_DESC])
            ->offset($pages->offset)
            ->limit($pages->limit);

        return $this->render('index', [
            'users' => $query->all(),
        ]);
    }


    public function actionAdd() {
        $model = new Users();

        if ($post = Yii::$app->request->post('Users')) {
            $model->load(Yii::$app->request->post());
            $model->save() ? $model->addSuccess('Успешно') : $model->addWarning('Ошибка при сохранении');
            return $this->redirect(['/admin/users']);
        }

        return $this->render('add', [
            'model' => $model,
        ]);
    }

    /**
     * @param $ID
     * @return string
     * @throws HttpException
     * @throws \yii\db\Exception
     */
    public function actionEdit($ID = false) {
        $model = is_numeric($ID) ? Users::findOne((int) $ID) : false;
        if (!$model) {
            throw new HttpException(404, "Страница не найдена.");
        }

        if ($post = Yii::$app->request->post('Users')) {
            $model->load(Yii::$app->request->post());
            $model->save() ? $model->addSuccess('Успешно') : $model->addWarning('Ошибка при сохранении');
            return $this->redirect(['/admin/users']);
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }
}