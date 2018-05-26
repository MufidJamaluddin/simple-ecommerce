<!-- HEADER -->
<!DOCTYPE html>
<html lang="en">
    <head>
	
	    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
        <title>
            Shopping Cart PPL 1
        </title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
        <style>
            .margin-top
			{
                margin-top: 9px;
            }
			.abu
			{
				background-color: #f4f4f4;
			}
			.putih
			{
				background-color: #ffffff;
				box-shadow: 0 1px 2px 1px rgba(166,166,166,.2);
			}
			.navbar-shadow
			{
				background-color: rgba(255, 255, 255, 0.7);
				box-shadow: 0 1px 2px 1px rgba(166,166,166,.1);
			}
			.foot
			{
				color: white;
				background-color: #2e2e2e;
			}
			.btn-default
			{
				background-color: #ffffff;
				box-shadow: 0 1px 2px 1px rgba(166,166,166,.2);
			}
			.list-group-item
			{
				background: none;
				color: white;
				box-shadow: none;
				border: none;
			}
        </style>
    </head>
    <body>

        <section>
		
            <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-trans navbar-shadow">

                <a class="navbar-brand" href="#">
                    <img class="img-responsive" style="width:50px" src="assets/img/logo/logo-kpi9.png"/>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
					<ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Beranda <span class="sr-only">(current)</span></a>
                        </li>
               
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php/konfirmasi">Konfirmasi Pembayaran</a>
                        </li>
                    </ul>
					
					<ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="index.php/cart">
								Shopping Cart 
								<span class="badge badge-secondary" id="jml_barang">
									<?php
										$m_session = MufidJ\Lib\SessionAdapter::getSession();
										echo isset($m_session['shp_cart']) ? sizeof($m_session['shp_cart']) : '0';
									?>
								</span> 
							</a>
                        </li>
                    </ul>

                </div>
            </nav>
			
			<div style="margin-top:53px"></div>

        </section>
