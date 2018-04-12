<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;
use app\models\Product;
use yii\data\Pagination;
//use yii\web\Request;
class CategoryController extends AppController{
	
	public function actionIndex(){
		
		$hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
		$this->setMeta("E-SHOPER");
		return $this->render('index', compact('hits'));
	}
	
	public function actionView($id){
		//$id = Yii::$app->request->get('id');
		$query = Product::find()->where(['category_id' => $id]);
		$pages = new Pagination(["totalCount" => $query->count(), "pageSize" => 3, "forcePageParam" => false, "pageSizeParam" => false]);
		$product = $query->offset($pages->offset)->limit($pages->limit)->all();
		$category = Category::findOne($id);
		if ($category === null) { // item does not exist
			throw new \yii\web\HttpException(404, 'Такой категории товаров нет.');
		}
		$this->setMeta("E-SHOPER | ".$category->name, $category->keywords, $category->description);
		return $this->render('view', compact('product','category','pages'));
	}
	
	public function actionSearch(){
		$q = trim(Yii::$app->request->get('q'));
		if(!$q){
			return $this->render('search');
		}
		$query = Product::find()->where(['LIKE', 'name', $q]);
		$pages = new Pagination(["totalCount" => $query->count(), "pageSize" => 3, "forcePageParam" => false, "pageSizeParam" => false]);
		$product = $query->offset($pages->offset)->limit($pages->limit)->all();
		return $this->render('search', compact('product','pages','q'));
	}
}
?>