<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\widgets\ListView;

$this->title = 'Home';
?>
<?php Pjax::begin(['enablePushState' => true,'timeout'=>100000]); ?>
<div class="scrolling-wrapper">
  <div class="section-selector">
      <div class="d-flex justify-content-center text-uppercase">
          <?php foreach ($types as $t) { ?>
              <?=Html::a($t->display_name,['/'.$t->name],['class'=>'module-navigation-element '.($resTypeObject->id==$t->id?'active':'')]);?>
          <?php } ?>
      </div>
  </div>
</div>
<div class="module-container" id="module-container">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'resType-views/_'.$resTypeObject->name,
        'summary' => '',
        'pager' => [
          'options' => ['class' => 'pagination d-flex justify-content-center semibold'],
          'prevPageLabel' => '',
          'nextPageLabel' => '',
        ],
    ]) ?>
<?php Pjax::end(); ?>
