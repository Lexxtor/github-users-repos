<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Показывает список репозиториев.
     *
     * @return string
     * @throws NotFoundHttpException если список не сохранен в кэше
     */
    public function actionIndex()
    {
        $items = Yii::$app->cache->get('usersRepos');

        if (!$items) {
            throw new NotFoundHttpException('Список не загружен.');
        }

        return $this->render('list', ['items' => $items]);
    }
}
