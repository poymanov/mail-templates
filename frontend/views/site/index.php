<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Templates';
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <?php foreach ($templates as $template): ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <div class="caption">
                        <h3><?=$template->title?></h3>
                        <p><a href="<?=Url::to(['/site/template/', 'id' => $template->id])?>" class="btn btn-primary" role="button">View</a></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
