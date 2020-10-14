<? header('Access-Control-Allow-Origin: *'); ?>
<? header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method"); ?>
<? header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE"); ?>
<? header("Allow: GET, POST, OPTIONS, PUT, DELETE"); ?>
<? header('Content-Type: application/json'); ?>
<?

error_reporting(0);
ini_set('display_errors', 0);

if (isset($_SERVER['HTTP_ORIGIN']))
{
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400'); // cache for 1 day
    
}

include ("../cnx/swgc-mysql.php");

$tDirImagen = "http://app-catrina.sdibabec.com/cla/";

session_start();

if (!isset($_SESSION['carrito']))
{
    $_SESSION['carrito'] = array();
}

$errores = array();

$resultados = array();

$data = json_decode(file_get_contents('php://input'));

$pf = fopen("log.txt","a");
fwrite($pf,json_encode($data)."\n\n");
fclose($pf);

$accion = strtolower($_GET['tAccion'] . '-' . substr($_GET['tModulo'], 0, 4));

switch ($accion)
{
    case 'add-cart':
        $eCodProducto = $data->eCodProducto;
        $eCantidad = $data->eCantidad;
        $tIdentificador = substr(uniqid() , 0, 8) . '-' . date('ymdhi');

        $_SESSION['carrito'][] = array(
            'producto' => $eCodProducto,
            'cantidad' => $eCantidad,
            'identificador' => $tIdentificador
        );

        $resultados = array(
            "exito" => ((!sizeof($errores)) ? 1 : 0) ,
            'errores' => $errores,
            'productos' => sprintf("%02d", sizeof($_SESSION['carrito']))
        );
    break;
    case 'del-cart':
        $eIndice = $data->eIndice ? $data->eIndice : 0;

        array_splice($_SESSION['carrito'], $eIndice, 1);
        //unset($_SESSION['carrito'][$eIndice]);
        $resultados = array(
            "exito" => ((!sizeof($errores)) ? 1 : 0) ,
            'errores' => $errores,
            'productos' => sprintf("%02d", sizeof($_SESSION['carrito']))
        );
    break;
    case 'sup-cart':
        $_SESSION['carrito'] = array();

        $resultados = array(
            "exito" => ((!sizeof($errores)) ? 1 : 0) ,
            'errores' => $errores,
            'productos' => sprintf("%02d", sizeof($_SESSION['carrito']))
        );
    break;
    case 'upd-cart':
        $_SESSION['carrito'] = array();
        foreach ($data->productos as $producto)
        {
            $tIdentificador = substr(uniqid() , 0, 8) . '-' . date('ymdhi');
            $_SESSION['carrito'][] = array(
                'producto' => $producto->eCodProducto,
                'cantidad' => $producto->eCantidad,
                'identificador' => $tIdentificador
            );
        }
        $resultados = array(
            "exito" => ((!sizeof($errores)) ? 1 : 0) ,
            'errores' => $errores,
            'productos' => sprintf("%02d", sizeof($_SESSION['carrito']))
        );
    break;
    case 'add-tran':
        //agregamos la transacción
        $tDescripcion = "Pedido del " . date('Y-m-d H:i:s', strtotime("-6 hour")) . "\n\n";

        $eCodClente = $_SESSION['sesionCliente'] ? $_SESSION['sesionCliente']['eCodCliente'] : false;
        $tNombres = $data->tNombres ? "'" . $data->tNombres . "'" : "NULL";
        $tApellidos = $data->tApellidos ? "'" . $data->tApellidos . "'" : "NULL";
        $tCorreo = $data->tCorreo ? "'" . $data->tCorreo . "'" : "NULL";
        $tPassword = "'" . base64_encode(substr(uniqid() , 0, 8)) . "'";
        $tTelefonoFijo = $data->tTelefonoFijo ? "'" . $data->tTelefonoFijo . "'" : "NULL";
        $tTelefonoMovil = $data->tTelefonoMovil ? "'" . $data->tTelefonoMovil . "'" : "NULL";
        $fhFechaCreacion = "'" . date('Y-m-d H:i:s', strtotime("-6 hour")) . "'";
        $eCodEstatus = 3;

        $_SESSION['tFormaPago'] = $data->selector;

        if (!$eCodCliente)
        {
            $select = "SELECT eCodCliente FROM CatClientes WHERE tCorreo = $tCorreo";
            $rCliente = mysql_fetch_array(mysql_query($select));
            if ($rCliente{'eCodCliente'})
            {
                $eCodCliente = $rCliente{'eCodCliente'};
                $_SESSION['sesionCliente'] = $rCliente;
            }
            else
            {
                $insert = " INSERT INTO CatClientes
            (
                tNombres,
                tApellidos,
                tCorreo,
                tPassword,
                tTelefonoFijo,
                tTelefonoMovil,
                fhFechaCreacion,
                eCodEstatus
            )
            VALUES
            (
                $tNombres,
                $tApellidos,
                $tCorreo,
                $tPassword,
                $tTelefonoFijo,
                $tTelefonoMovil,
                $fhFechaCreacion,
                $eCodEstatus
            )";

                $tDescripcion .= $insert . "\n\n";

                $rs = mysql_query($insert);
                if ($rs)
                {
                    $eCodCliente = mysql_insert_id();
                    $rCliente = mysql_fetch_array(mysql_query("SELECT * FROM CatClientes WHERE eCodcliente = $eCodCliente"));
                    $_SESSION['sesionCliente'] = $rCliente;
                }
                else
                {
                    $errores[] = "Error al guardar el cliente " . mysql_error();
                }
            }
        }

        if ($eCodCliente)
        {
            $tCalle = $data->tCalle ? $data->tCalle : "NULL";
            $tEstado = $data->tEstado ? $data->tEstado : "NULL";
            $tMunicipio = $data->tMunicipio ? $data->tMunicipio : "NULL";
            $tCP = $data->tCP ? $data->tCP : "NULL";
            $tInstrucciones = $data->tInstrucciones ? "'" . $data->tInstrucciones . "'" : "NULL";

            $tIdentificador = "'" . substr(uniqid() , 0, 8) . '-' . date('ymd') . "'";
            $tCodEstatus = "'NU'";
            $eCodEtapa = 1;

            $tDireccionEnvio = "'$tCalle \n $tEstado \n $tMunicipio \n $tCP'";
            $fhFechaPedido = "'" . date('Y-m-d H:i:s') . "'";

            $_SESSION['orden'] = str_replace("'", "", $tIdentificador);

            $insert = " INSERT INTO BitPedidos
        (
            tIdentificador,
            eCodCliente,
            tCodEstatus,
            eCodEtapa,
            fhFechaPedido,
            tDireccionEnvio,
            tInstrucciones
        )
        VALUES
        (
            $tIdentificador,
            $eCodCliente,
            $tCodEstatus,
            $eCodEtapa,
            $fhFechaPedido,
            $tDireccionEnvio,
            $tInstrucciones
        )";

            $tDescripcion .= $insert . "\n\n";

            $rs = mysql_query($insert);
            if ($rs)
            {
                $eCodPedido = mysql_insert_id();
                $tDimensiones = "'Por correo'";

                for ($i = 0;$i < sizeof($_SESSION['carrito']);$i++)
                {
                    $eCodProducto = $_SESSION['carrito'][$i]['producto'];
                    $eCantidad = $_SESSION['carrito'][$i]['cantidad'];
                    $tDimensiones = "'Nada'";
                    $tIdentificador = "'" . $_SESSION['carrito'][$i]['identificador'] . "'";

                    $insert = " INSERT INTO RelPedidosProductos
                 (
                    eCodPedido,
                    eCodProducto,
                    eCantidad,
                    tDimensiones,
                    tIdentificador
                 )
                 VALUES
                 (
                    $eCodPedido,
                    $eCodProducto,
                    $eCantidad,
                    $tDimensiones,
                    $tIdentificador
                 )";

                    $tDescripcion .= $insert . "\n\n";

                    if (!mysql_query($insert))
                    {
                        $errores[] = "Error al guardar el producto $eCodProducto en el pedido $eCodPedido  " . mysql_error();
                    }

                }

            }
            else
            {
                $errores[] = "Error al guardar el pedido " . mysql_error() . " - " . $insert;
            }
        }

        if (!sizeof($errores))
        {
            //include ('../enviar.php');
        }
        else
        {
            $pf = fopen("logErrores.txt", "a");
            fwrite($pf, $tDescripcion);
            fclose($pf);
        }

        $resultados = array(
            "exito" => ((!sizeof($errores)) ? 1 : 0) ,
            'errores' => $errores,
            'productos' => sprintf("%02d", sizeof($_SESSION['carrito'])) ,
            'metodo' => ($data->selector)
        );
    break;
    case 'src-clie':
        $tCorreo = strtolower($data->tCorreo);

        $select = "SELECT * FROM CatClientes WHERE tCorreo='$tCorreo'";
        $rsCliente = mysql_query($select);
        $rCliente = mysql_fetch_array($rsCliente);

        $resultados = array(
            'tNombres' => ($rCliente{'tNombres'} ? $rCliente{'tNombres'} : '') ,
            'tApellidos' => ($rCliente{'tApellidos'} ? $rCliente{'tApellidos'} : '') ,
            'tTelefonoFijo' => ($rCliente{'tTelefonoFijo'} ? $rCliente{'tTelefonoFijo'} : '') ,
            'tTelefonoMovil' => ($rCliente{'tTelefonoMovil'} ? $rCliente{'tTelefonoMovil'} : '')
        );
    break;
    case 'con-prod':
        $eCodTipoProducto = $data->eCodTipoProducto ? $data->eCodTipoProducto : false;
        $eInicio = $data->ePagina ? (($data->ePagina * 20)-20) : 0;
        $eTermino = ($eInicio>0 ? $eInicio : 1) * 20;
        
        $tFiltro = $data->tFiltro ? $data->tFiltro : "tNombre ASC";
        
        $tHTML = '';
        
        $select = "SELECT * FROM CatProductos WHERE 1=1".
                  ($eCodTipoProducto ? " AND eCodTipoProducto = ".$eCodTipoProducto : "").
                  " ORDER BY ".$tFiltro;
                  
        $rMax = mysql_num_rows(mysql_query($select));
        
        $eMax = round($rMax/20);
        
        $select = "SELECT * FROM ($select)N0 LIMIT $eInicio, $eTermino";
        $rsProductos = mysql_query($select);
        while($rProducto = mysql_fetch_array($rsProductos))
        {
            $tHTML .= '<div class="single_product_item col-md-4" style="text-align:center">
                            <a href="/es/detalles/v1/'.sprintf("%07d",$rProducto{'eCodProducto'}).'/">
                                    <img src="'.$tDirImagen.$rProducto{'tImagen'}.'" alt="" class="img-fluid" style="max-height:300px;">
                                    <h3> '.($rProducto{'tNombre'}).' </h3>
                                    <p>$'.number_format($rProducto{'dPrecio'},2,'.',',').'</p>
                            </a>
                       </div>';
        }
        
        if(!mysql_num_rows($rsProductos))
        {
            $tHTML = '<h3><b>Sin productos por el momento</b></h3>';
        }
        
        $resultados = array('eMaxPaginas'=>$eMax,
                            'tHTML'=>$tHTML);
        
    break;
    case 'con-inic':
        
        $tHTML = '';
        
        $select = "SELECT DISTINCT * FROM CatProductos 
                   ORDER BY eCodProducto DESC LIMIT 0,12";
                 
         
        $rsProductos = mysql_query($select);
        
        
        
        while($rProducto = mysql_fetch_array($rsProductos))
        {
            $tHTML .= '<div class="col-xl-4 col-lg-4 col-md-4">
                        <a href="/es/detalles/v1/'.sprintf("%07d",$rProducto{'eCodProducto'}).'/">
                                <div class="single-product mb-60">
                                    <div >
                                        <img src="'.$tDirImagen.$rProducto{'tImagen'}.'" alt="" style="max-height:300px;">
                                    </div>
                                    <div class="product-caption">
                                        <h4>'.(($rProducto{'tNombre'})).'</h4>
                                        <div class="price">
                                            <ul>
                                                <li>$'.number_format($rProducto{'dPrecio'},2,'.',',').'</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>';
        }
        
        
        if(!mysql_num_rows($rsProductos))
        {
            $tHTML = '<h3><b>Sin productos por el momento</b>'.$select.'</h3>';
        }
        
        $resultados = array('select'=>$select,'tHTML'=>$tHTML);
        
    break;
    case 'det-prod':
        $eCodProducto = $data->eCodProducto ? $data->eCodProducto : false;
        $select = "SELECT * FROM CatProductos WHERE eCodProducto = ".$eCodProducto;
        $rProducto = mysql_fetch_array(mysql_query($select));
        $resultados = array(
            'codigo'=>$rProducto{'eCodProducto'},
            'titulo'=>($rProducto{'tNombre'}),
            'descripcion'=>($rProducto{'tDescripcion'}),
            'precio'=>utf8_encode('$'.number_format($rProducto{'dPrecio'},2,'.',',')),
            'imagen'=>$tDirImagen.$rProducto{'tImagen'}
            );
    break;
    
}

print json_encode($resultados);
?>
