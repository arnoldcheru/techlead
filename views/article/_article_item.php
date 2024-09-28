<?php
use yii\helpers\Html;
?>

<a>

<a href="<?php echo \yii\helpers\Url::to(['/article/view', 'id' => $model -> id]) ?>">
<h3></h3><?php echo \yii\helpers\Html::encode($model->title) ?>
</a>

<div>
<?php echo \yii\helpers\StringHelper::truncateWords($model->getEncodedBody(), 40); ?>

</div>

<p class="text-muted text-right">
    <small><b> Created At: <?php echo Yii::$app->formatter->asDatetime($model->created_at) ?></b> <br>
       <b> By: <?php echo $model->createdBy ? $model->createdBy->username : 'Unknown User' ?></b>
    </small>
</p>

</div>
