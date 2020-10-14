<?php
$select = "SELECT * FROM BitPublicaciones WHERE eCodPublicacion=".$_GET['v1'];
$rs = mysql_query($select);
$r = mysql_fetch_array($rs);
?>
	<!-- blog -->
	<div class="blog-w3l py-5">
		<div class="container py-xl-5 py-lg-3">
			<!-- heading title -->
			<div class="text-center mb-lg-5 mb-4">
				<h3 class="title-wthree mb-2">
					<span class="mt-2 text-uppercase font-weight-bold"><?=base64_decode($r{'tTitulo'});?></span></h3>
			</div>
			<!-- //heading title -->
			<div class="row blog-content">
				<!-- left side -->
				<div class="col-lg-12 left-blog-info text-left">
					<div class="blog-grid-top">
						<div class="b-grid-top">
							<div class="blog_info_left_grid">
								<a href="#">
									<img src="<?=$tBaseImagen.$r{'tImagen'};?>" class="img-fluid" alt="">
								</a>
							</div>
						</div>

						<h3 class="white-text" style="color:#FFF !important;">
                        <?=base64_decode($r{'tTitulo'});?>
                        </h3>
                        <div style="color:#FFF !important;">
                        <?=base64_decode($r{'tContenido'});?>
</div>
					</div>

					
				</div>
				<!-- //left side -->

				<!-- right side -->
				
				<!-- //right side -->
			</div>
		</div>
	</div>
	<!-- //blog -->
