<?php
if(isset($_SESSION['grand_total']))
{

?>
	<section>
		<div class="jumbotron jumbotron-fluid">
			<div class="container text-center">
				<h1 class="display-4">Pembelian Sukses!</h1><br/>
				<a class="h-4">
					Mohon segera lunasi pembayaran sebesar Rp<?=number_format($_SESSION['grand_total'],2,",",".");?>
				</a>
				<br/><br/>
			</div>
		</div>
	</section>

<?php

}

unset($_SESSION['grand_total']);
unset($_SESSION['shp_cart']);

?>