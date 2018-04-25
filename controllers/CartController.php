<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;
use app\models\Product;
use app\models\Order;
use app\models\OrderItems;
use app\models\Cart;
use yii\helpers\Html;
class CartController extends AppController{
	
	public function actionAdd(){
		
		$id = Yii::$app->request->get('id');
		$qty = Yii::$app->request->get('qty');
		$product = Product::findOne($id);
		if(empty($product)){
			return false;
		}
		$session = Yii::$app->session;
		$session->open();
		$cart = new Cart();
		$qty = !$qty ? 1 : $qty;
		$cart->addToCart($product, $qty);
		if( !Yii::$app->request->isAjax){
			return $this->redirect(Yii::$app->request->referrer);
		}
		//debug($session['cart']);
		$this->layout = false;
		return $this->render('cart-modal', compact('session'));
	}
	
	public function actionClear(){
		$session = Yii::$app->session;
		$session->open();
		$session->remove('cart');
		$session->remove('cart.qty');
		$session->remove('cart.sum');
		$this->layout = false;
		return $this->render('cart-modal', compact('session'));
	}
	
	public function actionDel(){
		$id = Yii::$app->request->get('id');
		$session = Yii::$app->session;
		$session->open();
		$cart = new Cart();
		$this->layout = false;
		$cart->recalc($id);
		return $this->render('cart-modal', compact('session'));
	}
	
	public function actionShow(){
		
	}
	
	public function actionCartpage(){
		$session = Yii::$app->session;
		$session->open();
	//	debug($session['cart']);
		//$this->layout = false;
		return $this->render('cartpage', compact('session'));
	}
	/* 
	 public function actionPlus(){
		$id = Yii::$app->request->get('id');
		$qty = Yii::$app->request->get('qty');
		$price = Yii::$app->request->get('pr');
		$session = Yii::$app->session;
		$product = Product::findOne($id);
		if(empty($product)){
			return false;
		}
		$session->open();
		$cart = new Cart();
		//$this->layout = false;
		$cart->recalcQty($product, $qty, $price);
		return $this->render('cartpage', compact('session'));
	}  */
	
	public function actionView(){
		$id = Yii::$app->request->get('id');
		$session = Yii::$app->session;
		$session->open();
		$this->setMeta('корзина');
		$order = new Order();
		$post = Yii::$app->request->post();
		if( $order->load($post) && $order->validate()){
		    $order->qty = $session['cart.qty'];
		    $order->sum = $session['cart.sum'];
		    if($order->save()){
		        $this->saveOrderItems($session['cart'], $order->id);
		        Yii::$app->session->setFlash('success', 'Ваш заказ принят спасибо!');
		        Yii::$app->mailer->compose('order', ['session' => $session])
                    ->setFrom(['iskan.ali@yandex.ru' => 'yiishop.ru'])
                    ->setTo($order->email)
                ->setSubject('Закакз на сайте')
                ->send();
		        $session->remove('cart');
		        $session->remove('cart.qty');
		        $session->remove('cart.sum');
		        return $this->refresh();
            }else{
                Yii::$app->session->setFlash('error', 'Ой! Чтто то пошло не так!');
                echo $order->errors;
            }
        }
		return $this->render('view', compact('session', 'order'));
	}

	protected  function saveOrderItems($items, $order_id){
        foreach($items as $id => $item){
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['qty'] * $item['price'];
            $order_items->save();
        }
    }

}

?>