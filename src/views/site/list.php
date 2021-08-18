<?php
/* @var $this yii\web\View */
/* @var $items array */
/* @var $date int */

use yii\helpers\Html;

$this->title = 'GitHub users repositories list';
?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">GitHub Repository</th>
        <th scope="col">Updated</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $key => $item) { ?>
    <tr>
        <th scope="row"><?=++$key?></th>
        <td><?= Html::a(Html::encode($item['full_name']), Html::encode($item['url']), ['target' => '_blank'])?></td>
        <td><?=Yii::$app->formatter->asDatetime($item['updated'], 'php:Y.m.d H:i:s') ?></td>
    </tr>
    <?php } ?>
    </tbody>
</table>
<div class="float-left"><?= Html::a('Users CRUD', 'github-user/index') ?></div>
<div class="float-right">Updated <?=Yii::$app->formatter->asDatetime($date, 'php:Y.m.d H:i:s') ?></div>
