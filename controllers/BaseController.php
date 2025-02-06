<?php
namespace app\controllers;

use yii\web\Controller;

class BaseController extends Controller {

    protected $isShowHeaderMenu = true;

    public function setShowHeaderMenu($value) {
        $this->isShowHeaderMenu = (bool) $value;
    }

    public function isShowHeaderMenu() {
        return $this->isShowHeaderMenu;
    }
}
