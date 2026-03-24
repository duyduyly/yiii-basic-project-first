<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\helpers\Html;

$this->title = $name ?? 'Error';
?>
<h1><?= Html::encode($this->title) ?></h1>
<p><?= nl2br(Html::encode($message ?? 'An error occurred.')) ?></p>

