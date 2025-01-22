<?php
namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;

class Notices {
    public static $result = [
        'success' => null,
        'warning' => null,
        'error' => null,
    ];
    CONST SAVE_KEY = 'saveModelStatus';


    /**
     * @param $message
     * @return void
     */
    public static function addSuccess($message) {
        self::$result['success'] = $message;
        Yii::$app->session->set(self::SAVE_KEY, self::$result);
    }


    /**
     * @param $message
     * @return void
     */
    public static function addWarning($message) {
        self::$result['warning'] = $message;
        Yii::$app->session->set(self::SAVE_KEY, self::$result);
    }


    /**
     * @param $message
     * @return void
     */
    public function addError($message) {
        self::$result['error'] = $message;
        Yii::$app->session->set(self::SAVE_KEY, self::$result);
    }

    /**
     * @param $class
     * @return string
     */
    public static function alertSuccess($class = '') {
        return self::renderMessage(self::$result['success'], $class ? $class : 'alert alert-success alert-dismissible');
    }

    /**
     * @param $class
     * @return string
     */
    public static function alertWarning($class = '') {
        return self::renderMessage(self::$result['warning'], $class ? $class : 'alert alert-warning alert-dismissible');
    }

    /**
     * @param $class
     * @return string
     */
    public static function alertError($class = '') {
        return self::renderMessage(self::$result['error'], $class ? $class : 'alert alert-danger alert-dismissible');
    }

    /**
     * @return void
     */
    public static function showNotices() {
        if ($result = Yii::$app->session->get(self::SAVE_KEY)) {
            self::$result = $result;
        }

        if (self::$result['success']) {
            echo self::alertSuccess();
        } elseif(self::$result['warning']) {
            echo self::alertWarning();
        } elseif(self::$result['error']) {
            echo self::alertError();
        }
    }


    /**
     * @param $message
     * @param $class
     * @return string
     */
    public static function renderMessage($message, $class) {
        $html = Html::tag('div', Html::tag('strong', "{$message}: "));
        $html = Html::tag('div', $html, ['class' => ($class ? $class : ''), 'id' => 'saveModelStatus']);
        $html .= '<script>window.setTimeout(function(){$("#saveModelStatus").hide();}, 3000);</script>';
        return $html;
    }
}