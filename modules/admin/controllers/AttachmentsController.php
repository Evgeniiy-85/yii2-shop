<?php
namespace app\modules\admin\controllers;

use app\models\Cart;
use app\models\Order;
use app\models\OrderItems;
use app\modules\admin\models\Files;
use Yii;

class AttachmentsController extends AdminController {

    /**
     * @return string|void
     */
    public function actionAdd() {
        if (Yii::$app->request->isAjax && $data = Yii::$app->request->post()) {
            $this->layout = false;
            $files = new Files();
            $files->setAttributes(['dir' => $data['dir']]);
            $files->uploadImages();

            return $this->renderAjax('images', [
                'files' => $files,
            ]);
        }
    }
}
