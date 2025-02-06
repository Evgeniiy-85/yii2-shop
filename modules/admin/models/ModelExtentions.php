<?php
/**
 *  Класс расширения стандартных моделей Yii2
 *  - сообщения об успешной операции, информационные сообщения
*/
namespace app\modules\admin\models;

use Yii;
use yii\helpers\Html;

trait ModelExtentions {
    public $success = [];

    public $warnings = [];


    /**
    *  Метод добавляет собщение об успешной операции.
    *  @param (array) $params - класс, фоновый цвет ихображения и т.д. (class, color, bg) [bootstrap]
    */
    public function addSuccess($attribute, $message = '', $params = []) {
        if (is_string($attribute) && empty($message)) {
            $this->success[] = $attribute;
        } elseif (is_array($attribute)) {
            $this->success = array_merge($this->success, $attribute);
        } else {
            $this->success[$attribute] = $message;
        }
    }


    /**
    *  Метод добавляет информационный сообщения собщение операции.
    *  @param (array) $params - класс, фоновый цвет ихображения и т.д. (class, color, bg) [bootstrap]
    */
    public function addWarning($attribute, $message = '', $params = []) {
        if (is_string($attribute) && empty($message)) {
            $this->warnings[] = $attribute;
        } elseif (is_array($attribute)) {
            $this->warnings = array_merge($this->warnings, $attribute);
        } else {
            $this->warnings[$attribute] = $message;
        }
    }


    /**
     *  Генерирует сообщение об успешном завершении
     */
    public function alertSuccess($class = '') {
        return $this->renderMessage($this->success, $class ?: 'callout callout-success');
    }

    /**
     *  Генерирует предупреждение
     */
    public function alertWarnings($class = '') {
        return $this->alertWarning($class);
    }

    public function alertWarning($class = '') {
        return $this->renderMessage($this->warnings, $class ?: 'callout callout-warning');
    }

    /**
     *  Генерирует сообщение об успешном завершении
     */
    public function alertErrors($class = '') {
        return $this->renderMessage($this->errors, $class ?: 'callout callout-danger');
    }

    /**
     * @return void
     */
    public function showNotices() {
        if ($this->success) {
            echo $this->alertSuccess();
        } elseif($this->warnings) {
            echo $this->alertWarning();
        }
    }


    /**
     * @param $m
     * @param $class
     * @return string
     */
    public function renderMessage($m, $class) {
        $html = '';
        foreach ($m as $key => $val) {
            if (method_exists($this, 'attributeLabels')) {
                $attributes = $this->attributeLabels();
            }
            $attribute = !empty($attributes[$key]) ? $attributes[$key] : $key;

            if (is_array($val)) {
                $val = implode('<br>', $val);
            }

            $html .= Html::tag('div', (!empty($attribute) ? Html::tag('strong', "{$attribute}: ") : '') . $val);
        }

        return Html::tag('div', $html, ['class' => ($class ?: '')]);
    }
}
