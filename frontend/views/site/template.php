<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Template */

$this->title = $template->title;
$this->params['breadcrumbs'][] = $template->title;
?>
<div class="template-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::encode($template->content) ?></p>
</div>