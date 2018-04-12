<li class="panel-default">

	<a href="<?=yii\helpers\Url::to(['category/view', 'id' => $category['id']]);?>" class="panel-title">
		<h4 >
		<?=$category['name'];?>
		<?php if(isset($category['childs'])):?>
			<span class="badge pull-right"><i class="fa fa-plus"></i></span>
		<?php endif;?>
			</h4>
	</a>
	<?php if(isset($category['childs'])):?>
		<ul>
			<li><?=$this->getMenuHtml($category['childs']);?></li>
		</ul>
	<?php endif;?>
</li>