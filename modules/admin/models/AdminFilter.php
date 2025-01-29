<?php
namespace app\modules\admin\models;

use Yii;

trait AdminFilter {

    public function filterInit() {
        if ($this->load(Yii::$app->request->post())) {
            Yii::$app->session->set($this->filter_name, Yii::$app->request->post());
        } elseif (Yii::$app->request->get('reset_filter')) {
            Yii::$app->session->remove($this->filter_name);
        }

        $this->load(Yii::$app->session->get($this->filter_name));
    }
}
