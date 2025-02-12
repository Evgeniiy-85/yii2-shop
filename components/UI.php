<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\helpers\Html;

class UI extends Component {

    /**
     * @param $params $param['icon'] - класс Font Awesome
     * @param $mainparams
     * @return string
     */
    public static function contextMenu($params = null, $mainparams = null) {
        $content = '';
        $button = '<span class="context-button" title="Меню"><span></span><span></span><span></span></span>';

        if ($params) {
            foreach ($params as $param) {
                $attributes = [];

                if (!isset($param['show'])) {
                    $param['show'] = true;
                }

                if (!$param['show']) continue;

                if (!empty($param['href'])) {
                    $attributes['href'] = $param['href'];
                }

                if (!empty($param['target'])) {
                    $attributes['target'] = $param['target'];
                }

                if (!empty($param['id'])) {
                    $attributes['id'] = $param['id'];
                }

                if (!empty($param['class'])) {
                    $attributes['class'] = $param['class'];
                }

                if (!empty($param['onclick'])) {
                    $attributes['onclick'] = $param['onclick'];
                }

                if (!empty($param['style'])) {
                    $attributes['style'] = $param['style'];
                }

                if (!empty($param['title'])) {
                    $attributes['title'] = $param['title'];
                }

                /**
                 * Можно передавать аттрибуты для в виде
                 * data => ['param1' => '...', 'param1' => '...', ...]
                 */
                if (!empty($param['data'])) {
                    if (is_array($param['data'])) {
                        foreach ($param['data'] as $key => $item) {
                            $attributes["data-{$key}"] = $item;
                        }
                    } else {
                        $attributes['data'] = $param['data'];
                    }
                }

                $content .= Html::tag('li',
                    Html::tag('a', Html::tag('span', '', ['class' => "fa {$param['icon']}"]) . ' ' . $param['text'], $attributes)
                );
            }
            $content = Html::tag('ul', $content, ['class' => 'context-menu-list']);
        }

        return Html::tag('div', $button . $content, ['class' => 'context-menu ' . (!empty($mainparams['class']) ? $mainparams['class'] : '')]);
    }

    public static function alert($text, $class = 'default', $row = null) {
        $alert = Html::tag('div', Html::encode($text), ['class' => 'alert alert-' . $class]);

        if ($row) {
            $alert = Html::tag('div', $alert, ['class' => $row]);
        }

        return $alert;
    }


    /**
     * @param $rating
     * @return string
     */
    static function rating($rating) {
        $img = Html::tag('img','', ['class' => 'sale', 'src' => '/images/icons/rating-star.svg',]);
        $item = Html::tag('div', $img, ['class' => 'rating-item']);
        $html = str_repeat($item, $rating);

        if (($repeat = 5 - $rating) > 0) {
            $img = Html::tag('img','', ['class' => 'sale', 'src' => '/images/icons/rating-star-empty.svg',]);
            $item = Html::tag('div', $img, ['class' => 'rating-item']);
            $html .= str_repeat($item, $repeat);
        }
        return Html::tag('div', $html, ['class' => 'rating']);
    }
}
