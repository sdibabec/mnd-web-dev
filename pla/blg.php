<?php
//include ("../cnx/swgc-mysql.php");



session_start();

function cargarpublicaciones()
{
    $tDirImagen = "http://app.lacatrinaentrajinera.com/cni/";
    
    $select = "SELECT bp.*, su.tNombre tUsuario FROM BitPublicaciones bp INNER JOIN SisUsuarios su ON su.eCodUsuario=bp.eCodUsuario WHERE bp.tCodEstatus IN ('AC','FI') ORDER BY bp.eCodPublicacion DESC LIMIT 0,12";
    $rsPublicaciones = mysql_query($select);
    $i = 1;
    while($rPublicacion = mysql_fetch_array($rsPublicaciones))
    { ?> 
    <article class="blog_item col-lg-6">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="<?=$tDirImagen.$rPublicacion{'tImagen'};?>" alt="">
                                <a href="/es/ver-publicacion/v1/<?=sprintf("%07d",$rPublicacion{'eCodPublicacion'});?>/" class="blog_item_date">
                                    <h3><?=date('d/m/Y',strtotime($rPublicacion{'fhFecha'}));?></h3>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="/es/ver-publicacion/v1/<?=sprintf("%07d",$rPublicacion{'eCodPublicacion'});?>/">
                                    <h2><?=substr(base64_decode($rPublicacion{'tTitulo'}),0,100);?></h2>
                                </a>
                            </div>
                        </article>
    <? }
}

function cargarPublicacion($codigo)
{
    $tDirImagen = "http://app.lacatrinaentrajinera.com/cni/";
    
    $select = "SELECT bp.*, su.tNombre tUsuario FROM BitPublicaciones bp INNER JOIN SisUsuarios su ON su.eCodUsuario=bp.eCodUsuario WHERE bp.eCodPublicacion = $codigo";
    $rsPublicaciones = mysql_query($select);
    $rPublicacion = mysql_fetch_array($rsPublicaciones);
    
    $tTitulo    = base64_decode($rPublicacion{'tTitulo'});
    //$tContenido = nl2br(base64_decode($rPublicacion{'tContenido'}));
    $tContenido = nl2br(str_replace('img ','img class="img-responsive" ',(base64_encode($rPublicacion{'tContenido'}))));
    $tImagen    = $tDirImagen.$rPublicacion{'tImagen'};
    $tUsuario   = $rPublicacion{'tUsuario'};
    $tEstatus   = $rPublicacion{'tCodEstatus'};
    $fhFecha    = date('d/m/Y',strtotime($rPublicacion{'fhFechaActualizacion'}));
    
    return array(
    'titulo'=>$tTitulo,
    'contenido'=>$tContenido,
    'proceso'=>($rPublicacion{'bRequiereProceso'}>0 ? true : false),
    'enlace'=>($rPublicacion{'tEnlace'}!="#" ? $rPublicacion{'tEnlace'} : false),
    'imagen'=>$tImagen,
    'fecha'=>$fhFecha,
    'usuario'=>$tUsuario,
    'estatus'=>$tEstatus
    );
}

function cargarPagina($codigo=false)
{
    $tDirImagen = "http://app.lacatrinaentrajinera.com/cni/";
    
    $select = "SELECT bp.* FROM BitPaginas bp WHERE 1=1 ".($codigo ? " AND bp.tBreadcrumb = '$codigo'" : "");
    $rsPublicaciones = mysql_query($select);
    $rPublicacion = mysql_fetch_array($rsPublicaciones);
    
    $tTitulo    = base64_decode($rPublicacion{'tTitulo'});
    $tContenido = str_replace('img ','img class="img-responsive" ',(base64_encode($rPublicacion{'tContenido'})));
    
    return array(
    'titulo'=>$tTitulo,
    'contenido'=>$tContenido
    );
}
?>