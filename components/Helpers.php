<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\helpers\Html;

class Helpers extends Component {

    public function init() {
        parent::init();
    }

    /**
    *  Возвращает строку в транслитераци
    */
    public static function translit($str) {
        $converter = [
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '',    'ы' => 'y',   'ъ' => '',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        ];

        $raw = strtr($str, $converter);
        $raw = strtolower($raw);
        $raw = preg_replace(["#[^-a-z0-9_]+#u", "#\-{2,}#u"], '-', $raw);

        return trim($raw, "-");
    }


    /**
    *  Возвращает дату на русском языке
    */
    public static function dateSpeller($timestamp, $time = false) {
        return is_numeric($timestamp) ? str_replace(
            ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov','Dec'],
            ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'],
             date('j M Y г.' . ($time ? ' в H:i' : ''), $timestamp)
        ) : '';
    }

    /**
     * Возвращает название месяца на русском языке
     * @param $month_number
     * @return string
     */
    public static function getMonthNameByNum($month_number) {
        $monthes = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];

        return $monthes[$month_number-1];
    }

    /**
    *  Возвращает размер в удобночитаемом формате
    */
    public static function sizeSpeller($size) {
        $unit = ['Б','кБ','МБ','ГБ','ТБ'];
        return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }


    /* Работает как PuntoSwitcher */
    public static function languageSwitcher($string) {
        $converter = [
            'f' => 'а',		',' => 'б',		'd' => 'в',		'u' => 'г',
            'l' => 'д',		't' => 'е',		'`' => 'ё',		';' => 'ж',
            'p' => 'з',		'b' => 'и',		'q' => 'й',		'r' => 'к',
            'k' => 'л',		'v' => 'м',		'y' => 'н',		'j' => 'о',
            'g' => 'п',		'h' => 'р',		'c' => 'с',		'n' => 'т',
            'e' => 'у',		'a' => 'ф',		'[' => 'х',		'w' => 'ц',
            'x' => 'ч',		'i' => 'ш',		'o' => 'щ',		']' => 'ъ',
            's' => 'ы',		'm' => 'ь',		'\'' => 'э',	'.' => 'ю',
            'z' => 'я',

            'F' => 'А',		'<' => 'Б',		'D' => 'В',		'U' => 'Г',
            'L' => 'Д',		'T' => 'Е',		'~' => 'Ё',		':' => 'Ж',
            'P' => 'З',		'B' => 'И',		'Q' => 'Й',		'R' => 'К',
            'K' => 'Л',		'V' => 'М',		'Y' => 'Н',		'J' => 'О',
            'G' => 'П',		'H' => 'Р',		'C' => 'С',		'N' => 'Т',
            'E' => 'У',		'A' => 'Ф',		'{' => 'Х',		'W' => 'Ц',
            'X' => 'Ч',		'I' => 'Ш',		'O' => 'Щ',		'}' => 'Ъ',
            'S' => 'Ы',		'M' => 'Ь',		'\"' => 'Э',	'>' => 'Ю',
            'Z' => 'Я',
        ];

        if (preg_match("#[a-z]+#ui", $string)) {
            return strtr($string, $converter);
        } else {
            return strtr($string, array_flip($converter));
        }
    }


    /**
     * @param $alias
     * @param $count
     * @return string
     */
    public static function generateNewAlias($alias, $count = 0) {
        return $count ? "$alias-$count" : $alias;
    }


    /**
     * @param $alias
     * @param $model
     * @param $alias_field_name
     * @return string
     */
    public static function generateUniqueAlias($alias, $model, $alias_field_name) {
        $new_alias = $alias;
        $count = 0;

        while ($model::find()->select($alias_field_name)->where([$alias_field_name => $new_alias])->one()) {
            $new_alias = self::generateNewAlias($alias, ++$count);
        }

        return $new_alias;
    }


    /**
     * @param $time
     * @return false|string
     */
    public static function getDate($time) {
        return $time ? date('d.m.Y H:i:s', $time) : '--';
    }


    /**
     * @param $phrase
     * @return array
     */
    public static function splitWords($phrase) {
        $phrase = preg_replace('#\\s+#ui', ' ', $phrase);
        $data = [];

        foreach(explode(' ', $phrase) as $a){
            if ($tpm = trim($a)) {
                $data[] = $tpm;
            }
        }

        return $data;
    }


    public static function formatPrice($price) {
        return $price ? number_format($price, 0, ',', ' ') : 0;
    }
}
