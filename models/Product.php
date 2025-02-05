<?php

namespace app\models;

use app\components\Helpers;
use app\modules\admin\models\Files;
use app\modules\admin\models\ModelExtentions;
use Yii;
use yii\db\ActiveRecord;

class Product extends ActiveRecord {
    use ModelExtentions;

    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;

    public $prod_image;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['prod_title',], 'required'],
            [['prod_title', 'prod_image', 'prod_article', 'prod_images'], 'string'],
            [['prod_status', 'prod_price', 'prod_category'], 'integer'],
            [['prod_title', 'prod_alias', 'prod_article',], 'trim'],
        ];
    }


    /**
     * @return string[]
     */
    public function attributeLabels() {
        return [
            'prod_id' => 'ID продукта',
            'prod_title' => 'Название',
            'prod_alias' => 'Алиас',
            'prod_image' => 'Обложка',
            'prod_price' => 'Цена',
            'prod_status' => 'Статус',
            'prod_category' => 'Категория',
            'prod_article' => 'Артикл'
        ];
    }


    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'products';
    }

    public function getCategories() {
        return $this->hasOne(Category::class, ['cat_id' => 'prod_category']);
    }

    /**
     * @return bool
     */
    public function beforeValidate() {
        $this->prod_images = $this->prod_images ? json_encode($this->prod_images, JSON_UNESCAPED_UNICODE) : null;

        return parent::beforeValidate();
    }

    /**
     * @param $insert
     * @return bool
     */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if (!$this->prod_alias) {
                $this->prod_alias = Helpers::Translit($this->prod_title);
            }

            if (!$this->prod_id) {
                $this->prod_alias = Helpers::generateUniqueAlias($this->prod_alias, $this, 'prod_alias');
            }

            if (($old_files = $this->getOldAttribute('prod_images')) && $old_files != $this->prod_images) {
                $old_files = json_decode($old_files, true);
                $files = $this->prod_images ? json_decode($this->prod_images, true) : [];

                if ($del_files = array_diff($old_files, $files)) {
                    Files::delFiles($del_files, 'products');
                }
            }

            return true;
        }

        return false;
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

    }

    public function afterFind() {
        parent::afterFind();
        $this->prod_images = $this->prod_images ? json_decode($this->prod_images, true) : false;
        $this->prod_image = $this->prod_images ? $this->prod_images[0] : null;
    }

    /**
     * @param $status
     * @return int|int[]
     */
    public static function getStatuses($status = false) {
        $statuses = [
            self::STATUS_DISABLED => 'Отключен',
            self::STATUS_ACTIVE => 'Активен',
        ];

        return $status !== false ? $statuses[$status] : $statuses;
    }


    /**
     * @param $category
     * @param $product
     * @param $parent_category
     * @param $breadcrumbs
     * @return array|mixed|string
     */
    public static function getBreadCrumbs($category, $product = null, $parent_category = null, &$breadcrumbs = []) {
        if ($product) {
            $breadcrumbs[] = ['label' => $product->prod_title];
            if (!$category) {
                return $breadcrumbs;
            }
            $parent_category = Category::find()
                ->where([
                    'cat_status' => [Category::STATUS_ACTIVE],
                    'cat_id' => $category->cat_parent,
                ])
                ->one();
        }

        $url = '/categories'.($parent_category ? "/{$parent_category->cat_alias}" : '')."/{$category->cat_alias}";
        $breadcrumbs[] = ['label' => $category->cat_title, 'url' => $url];

        if (!$category->cat_parent) {
            unset($breadcrumbs[0]['url']);
            return array_reverse($breadcrumbs);
        }

        $category = Category::find()
            ->where([
                'cat_status' => [Category::STATUS_ACTIVE],
                'cat_id' => $category->cat_parent,
            ])
            ->one();

        if (!$category) {
            return $breadcrumbs;
        }

        $parent_category = Category::find()
            ->where([
                'cat_status' => [Category::STATUS_ACTIVE],
                'cat_id' => $category->cat_parent,
            ])
            ->one();

        return self::getBreadCrumbs($category, null, $parent_category, $breadcrumbs);
    }


    public static function search($q, $query) {
        $query->andWhere(['like', 'prod_title', $q]);
    }
}