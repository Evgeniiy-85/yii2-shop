<?php

namespace app\components;

use yii\web\HttpException;
use Yii;
use yii\base\Component;
use yii\helpers\Html;


class SassPreprocessor extends Component
{

    public function getViewPath() {
        return;
    }

    public $scss;

    public function init() {
        if (file_exists(Yii::getAlias('@app/components/sass-php-lib/scss.inc.php'))) {
            include_once(Yii::getAlias('@app/components/sass-php-lib/scss.inc.php'));
        } else {
            throw new HttpException(400, 'Не найден файл класса SASS');
        }
        parent::init();
    }

    /**
     * @see Добавить автозагрузку файлов из папки
     *  сортировать по названию файла.
     * @see Так же добавить запуск компилятора только, если хотябы
     *  один из файлов новее, чем скомпилированный.
     */
    public static function run($path, $direction, $scss_files) {
        $css = '';
        $CONCAT = '';

        $SCSS = new \scssc();

        foreach ($scss_files as $folder => $file) {
            $extention = '.scss';

            if (is_array($file)) {
                $dir = Yii::getAlias("{$path}");

                foreach ($file as $infolder) {
                    if (file_exists("{$dir}{$folder}/{$infolder}{$extention}")) {
                        $CONCAT .= file_get_contents("{$dir}{$folder}/{$infolder}{$extention}");
                    } else {
                        throw new HttpException(400, "SassPreprocessor: Файл «{$dir}{$folder}/{$infolder}{$extention}» не найден");
                    }
                }
            } else {
                $file = Yii::getAlias("{$path}/{$file}");

                if (file_exists($file . $extention)) {
                    $CONCAT .= file_get_contents($file . $extention);
                } else {
                    throw new HttpException(400, "SassPreprocessor: Файл «" . $file . $extention . "» не найден");
                }
            }
        }

        try {
            $SCSS->setFormatter("scss_formatter_compressed");
            $css = $SCSS->compile($CONCAT);

            file_put_contents(Yii::getAlias($direction), $css);
        } catch (Exception $e) {
            print '<script>Ошибка компилятора SASS</script>';
        }
    }
}
