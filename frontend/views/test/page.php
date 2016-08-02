<?php
/* @var $this yii\web\View */
?>
<h1>分页测试</h1>

<p>
这是一个分页测试，转到<a href="<?php echo $pages->createUrl(4); ?>">第五页</a>
</p>

<?
use yii\widgets\LinkPager;
foreach ($models as $model) {
    // 在这里显示 $model
    echo 'id:'.$model->id;
    echo '  ';
    echo '名称:'.$model->name;
    echo '  ';
    //echo '父ID:'.$model->parent_id;
    echo '  ';
    echo '<hr/>';

}
echo LinkPager::widget([
    'pagination' => $pages,
    'maxButtonCount' => 10,
]);


?>
