<!--Modifica la tabla de product de la pagina product-->
<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>


                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'code',
                            'name',
                            'line',
                            'scale',
                            //'vendor',
                            //'description:ntext',
                            //'quantity_in_stock',
                            //'buy_price',
                            //'MSRP',
                            //'image',
                            [
                            	'format' => 'html',
                            	'attribute' => 'image',
                            	'value' => function($model, $key, $index, $column){
                            		return yii\helpers\Html::img(\Yii::$app->request->BaseUrl. '/'
                            			.Yii::$app->params['uploadImage']. $model->image,['height'=>80]);
                            		
                            		
                            	},
                            
                            ],

                            ['class' => 'hail812\adminlte3\yii\grid\ActionColumn',
        		                 'template' => \Yii::$app->user->can('storer') ? '{view} {update} {delete}':'{view}',
                             'urlCreator' => function ($action, $model, $key, $index) {
                             	    return Url::to([$action, 'code'=> $model->code]);
                             	  },
                            ],
                        ],
                        'summaryOptions' => ['class' => 'summary mb-2'],
                        'pager' => [
                            'class' => 'yii\bootstrap4\LinkPager',
                        ]
                    ]); ?>


                </div>
                <!--.card-body-->
            </div>
            <!--.card-->
        </div>
        <!--.col-md-12-->
    </div>
    <!--.row-->
</div>
<!--.Github /var/www/html/classic/modules/admin/views/product/index.php-->
