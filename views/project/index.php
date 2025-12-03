<?php

use app\models\Project;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ProjectSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-hover align-middle'],
        'columns' => [
            // 'id',
            [
                'attribute' => 'name',
                'label' => 'Project',
                'format' => 'raw',
                'value' => function ($model) {
                    /** @var app\models\Project $model */
                    return Html::a(Html::encode($model->name), ['view', 'id' => $model->id], [
                        'class' => 'fw-semibold text-decoration-none',
                    ]);
                },
            ],
            [
                'attribute' => 'client_id',
                'label' => 'Client',
                'value' => function ($model) {
                    return $model->client ? $model->client->name : '(None)';
                },
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    $map = [
                        'active' => 'success',
                        'on_hold' => 'warning',
                        'completed' => 'secondary',
                    ];
                    $labelMap = [
                        'active' => 'Active',
                        'on_hold' => 'On Hold',
                        'completed' => 'Completed',
                    ];
                    $status = $model->status ?? 'active';
                    $class = $map[$status] ?? 'secondary';
                    $text = $labelMap[$status] ?? ucfirst($status);

                    return '<span class="badge bg-' . $class . '">' . Html::encode($text) . '</span>';
                },
            ],
            [
                'attribute' => 'created_at',
                'label' => 'Created',
                'value' => function ($model) {
                    return date('Y-m-d', $model->created_at);
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    // hide update/delete for client users
                    'update' => !Yii::$app->user->identity->isClient(),
                    'delete' => !Yii::$app->user->identity->isClient(),
                ],
            ],
        ],
    ]); 
    ?>

</div>
