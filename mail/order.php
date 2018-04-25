<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
            <table style="width: 100%; max-width: 100%; margin-bottom: 20px;">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th></th>
                    <th style="text-align:center;">Наименование</th>
                    <th style="text-align:center;">Цена</th>
                    <th style="text-align:center;">Количество</th>
                    <th style="text-align:center;">Сумма</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; foreach($session['cart'] as $id => $item):?>
                    <tr>
                        <th><?=$i;?></th>
                        <td><?=Html::img("@web/images/home/{$item['img']}", ["class" => "img-rounded", "width" => 100,"alt" => "{$item['name']}"]);?></td>
                        <td><a href="<?=Url::to(["product/view", "id" => $id]);?>"><?=$item['name'];?></a></td>
                        <td style="text-align:center;" ><?=$item['price'];?></td>
                        <td style="text-align:center;" ><?=$item['qty'];?></td>
                        <td style="text-align:center;"><?=$item['qty'] * $item['price'];?></td>
                    </tr>
                    <?php $i++; endforeach;?>
                <tr>
                    <th></th>
                    <td></td>
                    <td>Итого: <?=$session['cart.sum'];?></td>
                    <td>Количество товаров: <?=$session['cart.qty'];?></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>