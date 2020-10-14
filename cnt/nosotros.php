<?php
$select = "SELECT * FROM BitPaginas WHERE eCodPagina=1";
$rs = mysql_query($select);
$r = mysql_fetch_array($rs);
?>
	<!-- page details -->
	<div class="breadcrumb-agile">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="/es/inicio/">Inicio</a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Nosotros</li>
			</ol>
		</nav>
	</div>
	<!-- //page details -->

	<!-- about -->
	<div class="about-w3l py-5">
		<div class="container py-xl-5 py-lg-3">
			<!-- heading title -->
			<div class="text-center mb-lg-5 mb-4">
				<h3 class="title-wthree mb-2">
                    <?=base64_decode($r{'tTitulo'});?>
                </h3>
			</div>
            <!-- //heading title -->
            <?=($r{'tContenido'});?>
			
		</div>
	</div>
	<!-- //about -->
	