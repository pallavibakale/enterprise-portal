<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use app\models\Comment;
use app\models\Project;
use yii\web\ForbiddenHttpException;


class CommentController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // only logged in users
                    ],
                ],
            ],
        ];
    }

    public function actionCreate($project_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $project = Project::findOne($project_id);
        if (!$project) {
            return ['success' => false, 'message' => 'Project not found'];
        }
        
        $user = Yii::$app->user->identity;
        if ($user && $user->isClient()) {
            if ($user->client_id === null || $project->client_id != $user->client_id) {
                return [
                    'success' => false,
                    'message' => 'You are not allowed to comment on this project.',
                ];
            }
        }

        $content = trim(Yii::$app->request->post('content', ''));
        if ($content === '') {
            return ['success' => false, 'message' => 'Comment cannot be empty'];
        }

        $comment = new Comment();
        $comment->project_id = $project_id;
        $comment->user_id = Yii::$app->user->id;
        $comment->content = $content;
        $comment->created_at = time();

        if ($comment->save()) {
            return [
                'success' => true,
                'html' => $this->renderPartial('@app/views/comment/_comment_item', [
                    'model' => $comment,
                ]),
            ];
        }

        return ['success' => false, 'message' => 'Failed to save comment'];
    }
}
