<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property string $code
 * @property string $name
 * @property string $line
 * @property string $scale
 * @property string $vendor
 * @property string $description
 * @property int $quantity_in_stock
 * @property float $buy_price
 * @property float $MSRP
 * @property string|null $image
 *
 * @property ProductLine $line0
 * @property OrderDetails[] $orderDetails
 * @property Order[] $orders
 */
class Product extends \yii\db\ActiveRecord
{
	 public $uploadFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'line', 'scale', 'vendor', 'description', 'quantity_in_stock', 'buy_price', 'MSRP'], 'required'],
            [['description'], 'string'],
            [['quantity_in_stock'], 'integer'],
            [['buy_price', 'MSRP'], 'number'],
            [['code'], 'string', 'max' => 15],
            [['name'], 'string', 'max' => 70],
            [['line', 'vendor'], 'string', 'max' => 50],
            [['scale'], 'string', 'max' => 10],
            [['image'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['line'], 'exist', 'skipOnError' => true, 'targetClass' => ProductLine::className(), 'targetAttribute' => ['line' => 'code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'line' => Yii::t('app', 'Line'),
            'scale' => Yii::t('app', 'Scale'),
            'vendor' => Yii::t('app', 'Vendor'),
            'description' => Yii::t('app', 'Description'),
            'quantity_in_stock' => Yii::t('app', 'Quantity In Stock'),
            'buy_price' => Yii::t('app', 'Buy Price'),
            'MSRP' => Yii::t('app', 'Msrp'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

    /**
     * Gets query for [[Line0]].
     *
     * @return \yii\db\ActiveQuery|ProductLineQuery
     */
    public function getLine0()
    {
        return $this->hasOne(ProductLine::className(), ['code' => 'line']);
    }

    /**
     * Gets query for [[OrderDetails]].
     *
     * @return \yii\db\ActiveQuery|OrderDetailsQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetails::className(), ['product_code' => 'code']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery|OrderQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['id' => 'order_id'])->viaTable('order_details', ['product_code' => 'code']);
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
    
     public function upload() 
    {
    		if($this->validate()){
    			if($this->image) {
    				unlink(Yii::$app->params['uploadImage'] . $this->image);
    			}
    			$file = Yii::$app->security->generateRandomString(). '.'. $this->uploadFile->extension;
    			if($this->uploadFile->saveAs(Yii::$app->params['uploadImage']. $file.false)){
					return $file;    			
    			}else {
					return false;    			
    			}
    		
    		} else {
				return false;    		
    		}
    }
}

//Github /var/www/html/classic/models/Product.php
