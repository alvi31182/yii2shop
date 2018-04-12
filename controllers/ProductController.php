<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;
use app\models\Product;
class ProductController extends AppController{
	
	public function actionView($id){
		
		$id = Yii::$app->request->get('id');
		$product = Product::findOne($id);
		if ($product === null) { // item does not exist
			throw new \yii\web\HttpException(404, 'Такого продукта нет.');
		}
		$hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
		$this->setMeta("E-SHOPER | ".$product->name, $product->keywords, $product->description);
		//$product = Product::find()->with('category')->where(['id' => $id])->limit(1)->one();
		return $this->render('view', compact('product','hits'));
	}
}

?>