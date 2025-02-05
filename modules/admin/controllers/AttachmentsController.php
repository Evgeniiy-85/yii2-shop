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
                'without_container' => true,
            ]);
        }
    }


    public function actionDelete() {
        $resp = [
            'status' => false,
        ];

        if (Yii::$app->request->isAjax && $data = Yii::$app->request->post()) {
            $this->layout = false;
            $path = Yii::getAlias("@webroot/load/{$data['dir']}/{$data['file']}");
            $resp['status'] = unlink($path);
        }

        header("Content-type: application/json; charset=utf-8");
        exit(json_encode($resp, JSON_UNESCAPED_UNICODE));
    }
}
