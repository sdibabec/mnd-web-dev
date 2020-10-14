<?php
include("swgc-mysql.php");

$tContenido = '<p>LA CATRINA EN TRAJINERA</p>

<br>

<p>LEYENDAS DE CALAVERAS GARBANCERAS 2020</p>

<br>

<p>HOMENAJE A FRIDA KAHLO Y DIEGO RIVERA</p>

<br>

<p>SEPTIMA TEMPORADA</p>

<br><br>

<p>Los boletos los puede adquirir en boletopolis y pagarlos en Oxxo o pagarlos por medio de : </p>

<img class="img-responsive" src="https://files.boletopolis.com/imagenes_eventos/hdpi/34839.png" alt="La Catrina en Trajinera"><br><br>

<p>Informes whastapp: 55 15 11 01 57 y al 55 54 54 89 65</p>

<br><br>

<p>FUNCIONES</p>

<ul>

<li>23 de octubre a las 19:30 hrs.</li>

<li>24 de octubre a las 19:30 hrs.</li>

<li>25 de octubre a las 19:30 hrs.</li>

<li>29 de octubre a las 19:30 hrs.</li>

<li>30 de octubre a las 19:30 hrs.</li>

</ul><br>

<p>FUNCIONES DOBLES</p>

<ul>

<li>31 de octubre 7:00 pm</li>

<li>31 de Octubre 9:30 pm</li>

</ul><br>

<ul>

<li>1° de Nov. 7:00 p.m.</li>

<li>1° de Nov. 9:30 p.m.</li>

</ul>

<br>

<p>ÚLTIMA FUNCIÓN</p>

<ul>

<li>2 de Nov a las 19:00 hrs.</li>

</ul><br>

<p>Costo entrada gral: $ 300 pesos.</p>

<br>

<p>Boleto VIP (Incluye cena y asiento en zona VIP)</p>

<br>

<p>Adulto: $ 700 pesos</p>

<br>

<p>Niño: $ 450 pesos</p>
';

$update = "UPDATE BitPaginas SET tContenido = '$tContenido' WHERE eCodPagina = 1";
mysql_query($update);
?>