
<div class="slider-middle py-5" id="models">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="title-wthree text-center mb-sm-5 mb-4">
				<span class="mt-2 text-uppercase font-weight-bold">Blog</span></h3>
			<div class="row">
                    <?php
                    $select = "SELECT * FROM BitPublicaciones ORDER BY eCodPublicacion DESC LIMIT 0,60";
                    $rsProductos = mysql_query($select);
                    while($rProducto = mysql_fetch_array($rsProductos)){ ?>
                    <div class="card my-4 col-md-3">
						<img class="card-img-top" src="<?=$tBaseImagen.$rProducto{'tImagen'};?>" alt="">
						<div class="card-body text-center">
							<h6 class="blog-first text-dark">
								<?=base64_decode($rProducto{'tTitulo'})?>
							</h6>
							<a href="/es/detalle/v1/<?=sprintf("%07d",$rProducto{'eCodPublicacion'})?>/" class="btn btn-primary blog-button mt-3">Seguir leyendo</a>
						</div>
                    </div>
                    
                    <? } ?>
			</div>
		</div>
	</div>