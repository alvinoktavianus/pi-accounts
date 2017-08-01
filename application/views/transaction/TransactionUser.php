<?php var_dump($transaction) ?>

<h2><?php echo $transaction['invoice_no'] . ' - ' . $transaction['created_at']; ?></h2>

<table class="table table-hover" style="border: 2px solid black !important;max-width: 1000px">
	<tr>
		<th class="text-center">No.</th>
		<th>Nama Barang</th>
		<th class="text-center">Qty</th>
		<th class="text-center">Harga</th>
		<th class="text-center">Jumlah</th>
	</tr>
<?php foreach ($transaction['details'] as $key => $value) { ?>
	<tr>
		<td class="text-center"><?php echo $key+1; ?></td>
		<td><?php echo $value['item_name']; ?></td>
		<td class="text-center"><?php echo $value['quantity']; ?></td>
		<td class="text-center"><?php echo $value['price']; ?></td>
		<td class="text-center"><?php echo $value['quantity'] * $value['price']; ?></td>
	</tr>
<?php } ?>
	<tr>
		<td colspan="3"></td>
		<td class="text-center"><strong>ONGKOS KIRIM</strong></td>
		<td class="text-center"><?php echo $transaction['shipping_fee']; ?></td>
	</tr>
	<tr>
		<td colspan="3"></td>
		<td class="text-center"><strong>GRAND TOTAL</strong></td>
		<td class="text-center"><?php echo $transaction['total']; ?></td>
	</tr>

</table>

<button type="button" class="btn btn-default btn-lg printbut" onClick="window.print()">
<span class="glyphicon glyphicon-print"></span>
</button>