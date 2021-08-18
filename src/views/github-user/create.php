<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\githubUser */

$this->title = 'Create Github User';
$this->params['breadcrumbs'][] = ['label' => 'Github Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="github-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
