<?php
namespace app\controllers;

use app\models\Settings;
use yii\web\Controller;

class BaseController extends Controller {

    protected $isShowHeaderMenu = true;
    public $settings;

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action) {
        $this->settings = Settings::findOne(1);
        return parent::beforeAction($action);
    }

    public function setShowHeaderMenu($value) {
        $this->isShowHeaderMenu = (bool) $value;
    }

    public function isShowHeaderMenu() {
        return $this->isShowHeaderMenu;
    }
}
