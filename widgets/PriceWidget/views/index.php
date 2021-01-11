<table class="table table-striped">
	<tr>
		<th>Наименование</th>
		<th>Цена</th>
	</tr>
	<?php foreach( $prices as $price ): ?>
		<tr>
			<td colspan="2"><h3><?=$price->title?></h3></td>
		</tr>
		<?php foreach($price->items as $item):?>
			<tr>
				<td><?=$item->item?></td>
				<td><?=$item->price?></td>
			</tr>
		<?php endforeach;?>
	<?php endforeach; ?>
</table>