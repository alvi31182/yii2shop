<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php if($session['cart']):?>
    <div class="container">
        <div class="row col-sm-8">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th></th>
                    <th scope="col" style="text-align:center;">Наименование</th>
                    <th scope="col" style="text-align:center;">Цена</th>
                    <th scope="col" style="text-align:center;">Количество</th>
                    <th scope="col" style="text-align:center;">Удалить</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; foreach($session['cart'] as $id => $item):?>
                    <tr>
                        <th scope="row"><?=$i;?></th>
                        <td><?=Html::img("@web/images/home/{$item['img']}", ["class" => "img-rounded", "width" => 100,"alt" => "{$item['name']}"]);?></td>
                        <td><a href="<?=Url::to(["product/view", "id" => $id]);?>"><?=$item['name'];?></a></td>
                        <td style="text-align:center;" ><?=$item['price'];?></td>
                        <td style="text-align:center;" ><?=$item['qty'];?></td>
                        <td style="text-align:center;"><span id="<?=$id;?>" class="glyphicon glyphicon-remove del-item" onclick="del(this.id)"></span></td>
                    </tr>
                    <?php $i++; endforeach;?>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>Итого: <?=$session['cart.sum'];?></td>
                    <td>Количество товаров: <?=$session['cart.qty'];?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td></td>
                    <td><a class="btn btn-default check_out" data-dismiss="modal" href="">Продолжить покупки</a></td>
                    <td><a class="btn btn-default addshoping" href="<?=Url::to(['cart/view']);?>">Оформить заказ</a></td>
                    <td><a class="btn btn-default remove" onclick="clearCart()" >Очистить корзину</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php else:?>
    <h2>Корзина пуста</h2>
<?php endif;?>