<?php

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@app/views/layouts/main.php');
?>
        <?= $content ?>
        <?= \yii\helpers\Html::a('Repositories', '/') ?>
<?php $this->endContent(); ?>