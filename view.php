<!--Nos da la vista de cada producto-->
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a(Yii::t('app', 'Update'), ['update', 'code' => $model->code], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'code' => $model->code], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'code',
                            'name',
                            'line',
                            'scale',
                            'vendor',
                            'description:ntext',
                            'quantity_in_stock',
                            'buy_price',
                            'MSRP',
                            [
                            'format' => 'html',
                            'attribute' => 'image',
                            'value' => yii\helpers\Html::img(\Yii::$app->request->BaseUrl.'/'
                            			.Yii::$app->params['uploadImage'].$model->image,['height'=>200]),
                            ],
                        ],
                    ]) ?>
                </div>
                <!--.col-md-12-->
            </div>
            <!--.row-->
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>
<!--.Github /var/www/html/classic/modules/admin/views/product/view.php-->
