<h2>
<?php
	$date = new DateTime($transaction['created_at']);
	echo $transaction['invoice_no'] . ' - ' . $date->format('d F Y | H:i'); ?>
		
</h2>

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
		<td class="text-center"><?php echo 'Rp ' . number_format($value['price'], 0, ",", "."); ?></td>
		<td class="text-center"><?php echo 'Rp ' . number_format($value['quantity'] * $value['price'], 0, ",", "."); ?></td>
	</tr>
<?php } ?>
	<tr>
		<td colspan="3"></td>
		<td class="text-center"><strong>ONGKOS KIRIM</strong></td>
		<td class="text-center"><?php echo 'Rp ' . number_format($transaction['shipping_fee'], 0, ",", "."); ?></td>
	</tr>
	<tr>
		<td colspan="3"></td>
		<td class="text-center"><strong>GRAND TOTAL</strong></td>
		<td class="text-center"><?php echo 'Rp ' . number_format($transaction['total'], 0, ",", "."); ?></td>
	</tr>

</table>

<button type="button" class="btn btn-default btn-lg printbut" onClick="window.print()">
<span class="glyphicon glyphicon-print"></span>
</button>