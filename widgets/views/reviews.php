<?php
use app\components\Helpers;
use app\models\User;
use app\components\UI;
use yii\helpers\Html;?>

<div class="product-reviews">
    <div class="reviews-header">
        <a href="">Отзывы <?=$count ? '('.Helpers::formatQuantity($count).')' : '';?></a>
    </div>

    <?if($reviews):?>
        <div class="reviews-list">
            <?foreach($reviews as $review):?>
                <div class="review">
                    <div class="review-top">
                        <div class="review-user">
                            <div class="user-avatar">

                            </div>

                            <div class="user-name">
                                <?=User::getUserFullName($review->users, true);?>
                            </div>
                        </div>

                        <div class="review-date">
                            <?=Helpers::dateSpeller($review['create_date']);?>
                        </div>

                        <div class="review-rating">
                            <?=UI::rating($review['review_rating']);?>
                        </div>
                    </div>

                    <div class="review-content">
                        <?if($review['review_advantage']):?>
                            <div class="review-item">
                                <div class="review-title">Достоинства</div>
                                <div class="review-text"><?=Html::encode($review['review_advantage']);?></div>
                            </div>
                        <?endif;?>

                        <?if($review['review_disadvantage']):?>
                            <div class="review-item">
                                <div class="review-title">Недостатки</div>
                                <div class="review-text"><?=Html::encode($review['review_disadvantage']);?></div>
                            </div>
                        <?endif;?>

                        <?if($review['review_comment']):?>
                            <div class="review-item">
                                <div class="review-title">Комментарий</div>
                                <div class="review-text"><?=Html::encode($review['review_comment']);?></div>
                            </div>
                        <?endif;?>
                    </div>
                </div>
            <?endforeach;?>
        </div>
    <?else:?>
        <h5 class="text-center">
            <b>Отзывов пока нет</b>
        </h5>
    <?endif;?>
</div>