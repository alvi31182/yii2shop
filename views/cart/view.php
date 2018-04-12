<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<?php if($session['cart']):?>
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php foreach( $session['cart'] as $id => $item):?>
						<tr class="cart_prices">
							<td class="cart_product">
								<a href="<?=Url::to(['product/view', 'id' => $id]);?>"><?=Html::img("@web/images/home/{$item['img']}", ["alt" => "{$item['name']}", "class" => "img-rounded"]);?><img src="images/cart/one.png" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="<?=Url::to(['product/view', 'id' => $id]);?>"><?=$item['name']?></a></h4>
							</td>
							<td class="cart_price">
								<p><?=$item['price'];?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" data-id="<?=$item['id'];?>" href="#"> + </a>
									<input class="cart_quantity_input" name="quantity" value="<?=$item['qty'];?>" autocomplete="off" size="2" type="text">
									<a class="cart_quantity_down" href="#"> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price"><?=$item['qty'] * $item['price'];?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" onclick="del(this.id)" id="<?=$id;?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
	
	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<?php $form = ActiveForm::begin();?>
						<?=$form->field($order, 'name')->label('Ваше имя');?>
						<?=$form->field($order, 'email')->label('Email');?>
						<?=$form->field($order, 'phone')->label('Телефон');?>
						<?=$form->field($order, 'address')->label('Ваш Адрес');?>
						<?php ActiveForm::end();?>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Продолжить</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Итог: <span><?=$session['cart.sum'];?></span></li>
							<li>Количество товаров: <span><?=$session['cart.qty'];?></span></li>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php else:?>
	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
		</div>
	</section>
	<?php endif;?>

