<section>
	<div class="jumbotron jumbotron-fluid putih" style="margin-bottom: 0">
		<div class="container">
			<div class="row">
				<div class="col-md-7 text-center">
					<h1 class="display-4">LaptopQ</h1>
					<p>Belanja Mudah & Murah</p>
				</div>
				<div class="col-md-5">
					<img class="img-responsive h-100" src="assets/img/foto/Apple-MacBook-Air-MMGF2.jpg" alt="">
				</div>
			</div>
		</div>
	</div>
</section>
		
<section>
	<div class="jumbotron jumbotron-fluid" style="background: linear-gradient(white, rgb(207, 223, 249, 0.9), white)">
		<div class="text-center">
			<h3>Produk Terbaru</h3>
		</div>
	</div>
</section>

<section class="base">
	<div class="container" style="padding-top: 10px">
		<div class="row">
					
			<?php
			
				$app->getListBarang(function($count, $barang){
			?>
					
				<div class="col-lg-3 col-md-5 mb-3">
					<div class="card h-100">
					    <img class="card-img-top" src="assets/img/foto/<?=$barang->gambar;?>" alt="<?=$barang->nama;?>">
						<div class="card-body text-center">
						    
							<h4 class="card-title">
								<a href="#"><?=$barang->nama;?></a>
							</h4>
							<a class="h6"><?=$barang->kodebrg;?></a><br/>
							<a class="h6">Rp<?=number_format($barang->harga,2,",",".");?></a><br/>
							<a class="h6">Stok <?=$barang->stok;?></a>
							
						</div>
						<div class="card-footer text-center">
							<button class="btn btn-default add_cart" data-value="<?=$barang->kodebrg;?>">
								Add To Cart
							</button>
						</div>
					</div>
				</div>
					
			<?php
			
				});
			
			?>
						
		</div>
	</div>
</section>