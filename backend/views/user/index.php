<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\User;


/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute'=>'id',
                'headerOptions' => ['width' => '50'],
                'contentOptions' =>['style'=>'text-align: center; vertical-align:middle;'],
            ],

            [
                'attribute'=>'username',
                'contentOptions' =>['style'=>'vertical-align:middle;'],
            ],

            [
                'attribute'=>'email',
                'format'=>'email',
                'contentOptions' =>['style'=>'vertical-align:middle;'],
            ],

            [
                'attribute' => 'status',
                'format' => 'text',
                'value' => function($model) {
                    switch($model->status) {
                        case User::STATUS_ACTIVE :
                            return 'Активный'; break;
                        case User::STATUS_DELETED :
                            return 'Удалённый'; break;
                        default :
                            return 'Неопределённый';
                    }
                },
                'contentOptions' =>['style'=>'vertical-align:middle;'],
            ],

            [
                'label' => 'Роль',
                'attribute' => 'role',
                'filter' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name'),
                'value' => function ($model) {
                    $userRoles = Yii::$app->authManager->getRolesByUser($model->id);
                    return array_shift($userRoles)->name;
                },
                'contentOptions' =>['style'=>'vertical-align:middle;'],
            ],

            [
                'attribute'=>'created_at',
                'format'=>'datetime',
                'contentOptions' =>['style'=>'vertical-align:middle;'],
            ],

            [
                'attribute'=>'updated_at',
                'format'=>'datetime',
                'contentOptions' =>['style'=>'vertical-align:middle;'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}&nbsp;&nbsp;&nbsp;&nbsp;{update}&nbsp;&nbsp;&nbsp;&nbsp;{delete}',
                'headerOptions' => ['width' => '150'],
                'contentOptions' =>['style'=>'font-size: 20pt; vertical-align:middle;'],
            ],
        ],
    ]); ?>
</div>
