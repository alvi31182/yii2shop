<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;
use app\models\Product;
use app\models\Cart; 

class ContactController extends AppController{
	
	
	public function actionCont(){
		return $this->render('cont');
	}
}
?>