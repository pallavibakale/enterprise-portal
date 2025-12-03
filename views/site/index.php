<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;

$this->title = 'Client Collaboration Portal';
?>
<div class="site-index">

    <div class="py-5 text-center">
        <h1 class="display-5 mb-3">Client Collaboration Portal</h1>
        <p class="lead mb-4">
            A secure workspace where teams and clients can collaborate on projects, share updates,
            and keep all communication in one place.
        </p>

        <div class="d-flex justify-content-center gap-3">
            <?= Html::a('Log In', ['site/login'], ['class' => 'btn btn-primary btn-lg']) ?>
            <?= Html::a('Contact Admin', 'mailto:admin@example.com', ['class' => 'btn btn-outline-secondary btn-lg']) ?>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Centralized Projects</h5>
                    <p class="card-text">
                        Track all client projects in one place with clear ownership, status, and history.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Secure Collaboration</h5>
                    <p class="card-text">
                        Role-based access ensures clients only see their own projects while your team
                        has the full picture.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Real-time Discussion</h5>
                    <p class="card-text">
                        Keep decisions and context in one place with project-level discussion threads.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
