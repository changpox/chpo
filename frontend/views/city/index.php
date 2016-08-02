<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

//use frontend\assets\AppAsset;
//use frontend\assets\BowerAsset;
//use frontend\widgets\Alert;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cities');
$this->params['breadcrumbs'][] = $this->title;

//AppAsset::register($this);
//BowerAsset::register($this);
//
//\frontend\assets\EditorAsset::register($this);

$js = <<<JS
    $('#goTop').click(function () {
        $('html,body').animate({scrollTop: '0px'}, 400);
    });
    $('#goBottom').click(function () {
        $('html,body').animate({scrollTop: $('.footer').offset().top}, 400);
    });

    //$(document).on("click", "#goTop", function () {
    //    $('html,body').animate({scrollTop: '0px'}, 0);
    //}).on("click", "#goBottom", function () {
    //    $('html,body').animate({scrollTop: $('.footer').offset().top}, 0);
    //}).on("click", "#refresh", function () {
    //    location.reload();
    //});
JS;
$this->registerJs($js);
?>
<div class="city-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create City'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $form = ActiveForm::begin(['id' => 'city-form']); ?>
    <?= $form->field($searchModel, 'area')->label('所在地')->widget(\common\widgets\city\CityWidget::className(), [
        'provinceAttribute' => 'province',
        'cityAttribute' => 'city',
        'areaAttribute' => 'area'
    ]) ?>
    <?php ActiveForm::end(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'parent_id',
            'sort',
            'deep',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <div class="btn-group-vertical" id="floatButton" style="right: 30px; bottom: 50%; position: fixed; cursor: pointer; opacity: 50;">
        <button type="button" class="btn btn-default" id="goTop" title="去顶部"><span
                class="glyphicon glyphicon-arrow-up"></span></button>
        <button type="button" class="btn btn-default" id="refresh" title="刷新"><span
                class="glyphicon glyphicon-repeat"></span></button>
        <button type="button" class="btn btn-default" id="pageQrcode" title="本页二维码"><span
                class="glyphicon glyphicon-qrcode"></span>
<!--            <img class="qrcode" width="130" height="130" src="--><?//= Url::to(['/site/qrcode', 'url' => Yii::$app->request->absoluteUrl])?><!--" />-->
        </button>
        <button type="button" class="btn btn-default" id="goBottom" title="去底部"><span
                class="glyphicon glyphicon-arrow-down"></span></button>
    </div>

<!--    <div style="display:none">-->
<!--        --><?//= \Yii::$app->setting->get('siteAnalytics'); ?>
<!--    </div>-->

<!--    --><?php
//    $this->registerJs(
//       // 'Config = {emojiBaseUrl: "' . $emojify->baseUrl . '"};',
//        \yii\web\View::POS_HEAD
//    );
//    ?>

    <div id="footer">
    </div>
</div>
