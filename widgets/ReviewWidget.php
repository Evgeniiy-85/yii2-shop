<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\models\ProductReview;

class ReviewWidget extends Widget {
    public $prod_id;

    public function run() {
        $query = ProductReview::find()
            ->where([
                'prod_id' => $this->prod_id,
                'review_status' => ProductReview::STATUS_ACTIVE
            ])
            ->joinWith('users');

        return $this->render('reviews', [
            'reviews' => $query->all(),
            'count' => $query->count()
        ]);
    }
}
