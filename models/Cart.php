<?php
namespace app\models;
use yii\db\ActiveRecord;
use yii\helpers\Json;
class Cart extends ActiveRecord{
	
	public function addToCart($product, $qty = 1, $prodqty = 1){
		if(isset($_SESSION['cart'][$product->id])){
			$_SESSION['cart'][$product->id]['qty'] += $qty;
			$_SESSION['cart'][$product->id]['totprice'] += $prodqty;
			$_SESSION['cart'][$product->id][$product->price] = $prodprice;
		}else{
			$_SESSION['cart'][$product->id] = [
				'prodqty' => $prodqty,
				'qty' => $qty,
				'id' => $product->id,
				'name' => $product->name,
				'price' => $product->price,
				'img' => $product->img
			];
		}
		$_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
		$_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $product->price : $qty * $product->price;
		$_SESSION['cart.totprice'] = isset($_SESSION['cart.totprice']) ? $_SESSION['cart.totprice'] + $qty * $product->price : $qty * $product->price;
	}
	
	public function recalc($id){
		if(!isset($_SESSION['cart'][$id])){
			return false;
		}
		$qtyMinus = $_SESSION['cart'][$id]['qty'];
		$sumMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
		$_SESSION['cart.qty'] -= $qtyMinus;
		$_SESSION['cart.sum'] -= $sumMinus;
		unset( $_SESSION['cart'][$id]);
	}
	
	public function recalcQty($product, $qty, $price){
		if(isset($_SESSION['cart'][$product->id])){
			$_SESSION['cart'][$product->id]['qty'] = $qty;
			
		}else{
			$_SESSION['cart'][$product->id] = [
				'qty' => $qty
			];
		}
		echo $_SESSION['cart']['tot'] =  $qty * $price;
		exit();
	}
	
	/* public function recalcminusQty($product, $qty, $price){
		if(isset($_SESSION['cart'][$product->id])){
			$_SESSION['cart'][$product->id]['qty'] = $qty;
			
		}else{
			$_SESSION['cart'][$product->id] = [
				'qty' => $qty
			];
		}
		echo $_SESSION['cart']['tot'] =  $qty * $price;
		exit();
	} */
}
?>