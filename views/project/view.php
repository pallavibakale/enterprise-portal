<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\Breadcrumbs;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Project $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<!-- <div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'client_id',
            'name',
            'description:ntext',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>
    <hr>

<h3>Discussion</h3>

<div id="comment-list">
    <?php foreach ($model->comments as $comment): ?>
        <?= $this->render('@app/views/comment/_comment_item', ['model' => $comment]) ?>
    <?php endforeach; ?>
</div>

<?php if (!Yii::$app->user->isGuest): ?>
    <div class="comment-form" style="margin-top: 15px;">
        <textarea id="comment-content" class="form-control" rows="3" placeholder="Write a comment..."></textarea>
        <br>
        <button id="btn-submit-comment" type="button" class="btn btn-primary">Post Comment</button>
    </div>
<?php else: ?>
    <p><em>Please login to participate in the discussion.</em></p>
<?php endif; ?>
</div> -->

<div class="project-view">

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title mb-3">
                        <?= Html::encode($model->name) ?>
                    </h3>
                    <p class="text-muted mb-2">
                        Client:
                        <strong><?= Html::encode($model->client ? $model->client->name : '(None)') ?></strong>
                    </p>

                    <?= DetailView::widget([
                        'model' => $model,
                        'options' => ['class' => 'table table-borderless mb-0'],
                        'attributes' => [
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
                                'attribute' => 'description',
                                'format' => 'ntext',
                            ],
                            [
                                'attribute' => 'created_at',
                                'value' => date('Y-m-d H:i', $model->created_at),
                            ],
                            [
                                'attribute' => 'updated_at',
                                'value' => date('Y-m-d H:i', $model->updated_at),
                            ],
                        ],
                    ]) ?>

                    <?php if (!Yii::$app->user->identity->isClient()): ?>
                        <div class="mt-3">
                            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary me-2']) ?>
                            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-outline-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this project?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Discussion block yahi rehne do, jo tumne pehle banaya -->
            <!-- (comment-list + textarea + script) -->
        </div>
    </div>
</div>

<?php
use yii\helpers\Url;

$commentUrl = Url::to(['comment/create', 'project_id' => $model->id]);
$csrfToken = Yii::$app->request->csrfToken;
?>

<script>
  console.log('comment script loaded');

  document.addEventListener('DOMContentLoaded', function() {
    console.log('DOMContentLoaded fired');

    var btn = document.getElementById('btn-submit-comment');
    console.log('btn is:', btn);

    if (!btn) return;

    btn.addEventListener('click', function() {
      console.log('comment button clicked');

      var textarea = document.getElementById('comment-content');
      if (!textarea) return;

      var content = textarea.value.trim();
      if (!content) {
        alert('Comment cannot be empty');
        return;
      }

      var params = new URLSearchParams();
      params.append('content', content);

      fetch('<?= $commentUrl ?>', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
          'X-CSRF-Token': '<?= $csrfToken ?>'
        },
        body: params.toString()
      })
      .then(function(response) {
        console.log('response status:', response.status);
        return response.json();
      })
      .then(function(data) {
        console.log('response json:', data);
        if (data.success) {
          var list = document.getElementById('comment-list');
          if (list) {
            list.insertAdjacentHTML('beforeend', data.html);
          }
          textarea.value = '';
        } else {
          alert(data.message || 'Error posting comment');
          if (data.errors) {
            console.log('Comment errors:', data.errors);
          }
        }
      })
      .catch(function(error) {
        console.error('Fetch error:', error);
        alert('Request failed');
      });
    });
  });
</script>
