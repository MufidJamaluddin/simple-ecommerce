		<section>
            <footer>
                <div class="jumbotron jumbotron-fluid foot" style="margin-bottom:0; bottom: 0;">
					<div class="container">
                        <div class="row">
                            <div class="col-md-6">
								<h3>Toko LaptopQ PPL 1</h3>
								<p class="text-justify">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!
								</p>
                            </div>
                            <div class="col-md-6">
								<div>
									<h4>Sosial Media</h4>
									<ul class="list-unstyled">
										<li>
											<a href="#" class="list-group-item"><img class="float-left" style="width: 30px; height: 30px;" src="assets/img/so-icon/inst.png">&nbsp;&nbsp;@Insagram</a>
										</li>
										<li>
											<a href="#" class="list-group-item"><img class="float-left" style="width: 30px; height: 30px;" src="assets/img/so-icon/fb.png">&nbsp;&nbsp;Facebook</a>
										<li>
										<li>
											<a href="#" class="list-group-item"><img class="float-left" style="width: 30px; height: 30px;" src="assets/img/so-icon/twt.png">&nbsp;&nbsp;@Twitter</a>
										</li>
										<li>
											<a href="#" class="list-group-item"><img class="float-left" style="width: 30px; height: 30px;" src="assets/img/so-icon/line.png">&nbsp;&nbsp;@Line</a>
										</li>
									</ul>
								</div>
                            </div>
                        </div>
                    </div>
                    <hr class="footer-divider">
                    <div class="copyright">
                        <p class="text-center">
                            &copy; 2018. Mufid Jamaluddin 161511019 D3 Teknik Informatika
                        </p>
                    </div>
                </div>
            </footer>
        </section>
		
		<section>
			<div class="modal" id="sukses">
				<div class="modal-dialog">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Sukses</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body">
							Barang Telah Ditambahkan ke Cart
						</div>

						<!-- Modal footer -->
						<div class="modal-footer">
							<a href="index.php/cart">
								<button type="button" class="btn btn-primary">Buka Cart</button>
							</a>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
						</div>

					</div>
				</div>
			</div>
		</section>

		<script src="assets/js/jquery.min.js"></script>
		<script>
		$(document).ready(function() {
			
			//var cart = $('#jml_barang').html();
			
			$('.add_cart').click(function(){
				
				var id = $(this).data("value"); 
				
				$.get("index.php/action_cart?action=add&kode=" + id, function(data){
				//	if(data === "1")
					//{
					//	cart++;
					$('#jml_barang').html(data);	
					$('#sukses').modal();
					//}
				//	else
					//	alert(data);
				});
				
			});
			
		});
		</script>
		<script src="assets/js/bootstrap.min.js"></script>
		
    </body>
</html>