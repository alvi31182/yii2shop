<?php
namespace app\models;
use yii\db\ActiveRecord;

class Product extends ActiveRecord{
	
	
	public static function tableNmae(){
		
		return 'product';
	}
	
	public function getCategory(){
		
		return $this->hasOne(Category::className(), ['id' => 'category_id']);
		
	}
	
	
}
?>