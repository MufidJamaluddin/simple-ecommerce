<section>
	<div class="jumbotron jumbotron-fluid" style="background:#fff; background: linear-gradient(white, rgb(207, 223, 249, 0.7), white);">
		<div class="container text-center">
			<h1 class="display-4">Konfirmasi Pembayaran</h1><br/>
		</div>
	</div>
</section>

<section>
	<div class="container-fluid">
		<div class="row">
		    <div class="table-responsive">
				<table class="table table-sm borderless">
					<thead class="thead-dark">	
						<tr>
							<th scope="col-sm-3">NoPJL</th>
							<th scope="col-sm-4">Tanggal</th>
							<th scope="col-sm-5">Nama</th>
							<th scope="col-sm-5">Alamat</th>
							<th scope="col-sm-4">HP</th>
							<th scope="col-sm-5">Tanggal Pembayaran</th>
							<th scope="col-sm-3">Jumlah Pembayaran</th>
							<th scope="col-sm-5">Validasi Pembayaran</th>
							<th scope="col-sm-4">Kode Barang</th>
							<th scope="col-sm-4">Harga Pembelian</th>
							<th scope="col-sm-3">Jumlah Barang</th>
                            <th scope="col-sm-4">Subtotal</th>
						</tr>
					</thead>
					<tbody>
						<?php
							
							$_SESSION['tmp_warna'] = 0;
							
							$_SESSION['tmp_nopjl'] = '';
							
							$app->getListKonfirmasi(function($count, $barang){
								
								$subtotal = $barang->harga * $barang->jumlah;
								
								if($barang->nopjl !== $_SESSION['tmp_nopjl'])
								{
								    if(isset($_SESSION['tmp_jml']))
								    {
						?>
						            <tr style="background-color:<?=$_SESSION['tmp_warna'];?>" class="text-center">
						                <td colspan="12">Grand Total Rp<?=number_format($_SESSION['tmp_jml'],2,',','.');?></td>
						            </tr>
						<?php
								    }
								    
						            $_SESSION['tmp_jml'] = 0;
						            
									if($_SESSION['tmp_warna'] === 'rgb(207, 223, 249, 0.7)')
										$_SESSION['tmp_warna'] = 'rgb(207, 242, 171, 0.6)';
									else
										$_SESSION['tmp_warna'] = 'rgb(207, 223, 249, 0.7)';
									
						?>
								<tr style="background-color:<?=$_SESSION['tmp_warna'];?>">
									<td><?=$barang->nopjl;?></td>
									<td><?=$barang->tgl;?></td>
									<td><?=$barang->nama;?></td>
									<td><?=$barang->alamat;?></td>
									<td><?=$barang->hp;?></td>
									<td><?=$barang->tgl_bayar;?></td>
									<td>Rp<?=number_format($barang->jml_bayar,2,',','.');?></td>

									<td>
										<form action="../index.php/konfirmasi" method="post">
											<input type="hidden" class="form-control" value="<?=$barang->nopjl;?>" name="nopjl"/>
											Jumlah Bayar Rp (int, jangan pakai Rp/titik/koma) <input type="text" class="form-control" name="jml_bayar"/>
											<button type="submit" class="btn btn-primary">
												Konfirmasi Pembayaran
											</button>
										</form>
									</td>
						<?php
								}
								else
								{
								    
						?>
								<tr style="background-color:<?=$_SESSION['tmp_warna'];?>">
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
						
						<?php
								}
								
								$_SESSION['tmp_jml'] += $subtotal; 
								
						?>
									<td><?=$barang->kodebrg;?></td>
									<td>Rp<?=number_format($barang->harga,2,',','.');?></td>
									<td><?=$barang->jumlah;?></td>
									<td>Rp<?=number_format($subtotal,2,',','.');?></td>
								</tr>

						<?php
								
								$_SESSION['tmp_nopjl'] = $barang->nopjl;
							
							});
							
						?>
						        <tr style="background-color:<?=$_SESSION['tmp_warna'];?>" class="text-center">
						            <td colspan="12">Grand Total Rp<?=number_format($_SESSION['tmp_jml'],2,',','.');?></td>
						        </tr>
						<?php
						
							unset($_SESSION['tmp_warna']);
							unset($_SESSION['tmp_nopjl']);
							unset($_SESSION['tmp_jml']);
						?>
					</tbody>		
				</table>
			</div>
		</div>
	</div>
</section>

