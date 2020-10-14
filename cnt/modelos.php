<?php
$select = "SELECT * FROM CatTiposProductos";
$rsTipos = mysql_query($select);
?>
	<!-- page details -->
	<div class="breadcrumb-agile">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="/es/inicio/">Home</a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Modelos</li>
			</ol>
		</nav>
	</div>
	<!-- //page details -->
<? while($rTipo = mysql_fetch_array($rsTipos)){ ?>
<!-- model slider -->
<div class="slider-middle py-5" id="models">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="title-wthree text-center mb-sm-5 mb-4">
				<span class="mt-2 text-uppercase font-weight-bold"><?=$rTipo{'tNombre'};?></span></h3>
			<div class="row">
                    <?php
                    $select = "SELECT * FROM CatProductos WHERE eCodTipoProducto = ".$rTipo{'eCodTipoProducto'};
                    $rsProductos = mysql_query($select);
                    while($rProducto = mysql_fetch_array($rsProductos)){ ?>
                    <div class="card my-4 col-md-3">
						<img class="card-img-top" src="<?=$tBaseImagen.$rProducto{'tImagen'};?>" alt="">
						<div class="card-body text-center">
							<h6 class="blog-first text-dark">
								<?=utf8_encode($rProducto{'tNombre'})?>
							</h6>
							
						</div>
                    </div>
                    
                    <? } ?>
			</div>
		</div>
	</div>
	<!-- //model slider -->
<? } ?>
    