<?php

namespace app\modules\admin\controllers;

use app\models\LoginForm;
use app\models\Product;
use app\models\User;
use app\modules\admin\models\Notices;
use app\modules\admin\models\UserFilter;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\HttpException;

class UsersController extends AdminController {

    public function actionIndex() {
        $page_size = 36;

        $query = User::find();
        $pages = new Pagination([
            'pageSize' => $page_size,
            'defaultPageSize' => $page_size,
            'totalCount' => $query->count()
        ]);

        $filter = new UserFilter();
        $filter->add($query);

        $query
            ->orderBy(['user_id' => SORT_DESC])
            ->offset($pages->offset)
            ->limit($pages->limit);

        return $this->render('index', [
            'users' => $query->all(),
            'filter' => $filter,
        ]);
    }


    public function actionAdd() {
        $model = new User();

        if ($post = Yii::$app->request->post('User')) {
            $model->load(Yii::$app->request->post());
            $model->save() ? Notices::addSuccess('Успешно') : Notices::addWarning('Ошибка при сохранении');
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
        $model = is_numeric($ID) ? User::findOne((int) $ID) : false;
        if (!$model) {
            throw new HttpException(404, "Страница не найдена.");
        }

        if ($post = Yii::$app->request->post('User')) {
            $model->load(Yii::$app->request->post());
            $model->save() ? Notices::addSuccess('Успешно') : Notices::addWarning('Ошибка при сохранении');
            return $this->redirect(['/admin/users']);
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }
}