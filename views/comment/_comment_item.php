<?php
use yii\helpers\Html;

/* @var $model app\models\Comment */
?>

<div class="comment-item" style="border-bottom: 1px solid #eee; padding: 8px 0;">
    <strong><?= Html::encode($model->user->username) ?></strong>
    <span style="font-size: 12px; color: #888;">
        <?= date('Y-m-d H:i', $model->created_at) ?>
    </span>
    <div style="margin-top: 4px;">
        <?= nl2br(Html::encode($model->content)) ?>
    </div>
</div>
