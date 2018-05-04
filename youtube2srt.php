<?php
/*
// Program     	: Convert YouTube text (having Transcript) from browser to Subtitle (.srt) file.
// Author       : Ap.Muthu <apmuthu@usa.net>
// Version      : 1.0
// Release Date : 2018-05-04
// Usage Notes  : Returns .srt file contents. Insert the last end time manually.
// Alternative  : Direct English translation online at http://mo.dbxdb.com/Yang/
*/

if (!isset($_POST['subbut']) || 
	!isset($_POST['yttext']) || 
	empty($_POST['yttext'])) {
?>
<form method="POST">
	<p>Enter Text of YouTube Content Page with Transcript:<br>
       <textarea name="yttext" rows="10" cols="80"></textarea></p>
    <p><input type="submit" name="subbut" value="Submit"></p>
	<p>Insert the last ending time in the output</p>
</form>
<?php
	exit;
}

$lf = chr(10);
/*
$str = <<<EOD
IN
0:01 / 23:14
Transcript
00:01
hola amigas vamos a tejer esta carpeta
00:04
utilizando hilo de algodón del número 10
00:07
y un gancho de metal delgado del número
00:11
2.25
00:17
nuestro hilo es un hilo delgado es de
00:20
algodón
00:22
número 10 ustedes pueden tejerla con el
00:24
hilo que tengan también el hilo cristal
00:26
les sirve
00:31
empezamos tejiendo siete cadenas voy a
00:36
tejer una cadenita jalamos y esa no la
00:38
vamos a contar 1 2
00:45
345
00:48
6 y 7 cadenitas cerramos en círculo
00:53
con punto deslizado
01:00
tenemos un pequeño arito
01:04
subimos con 4 cadenas
01:13
con cinco cadenas perdón
01:18
la sala doble
01:21
y en el centro
01:24
te queremos un pilar doble sin cerrar
01:28
2
01:32
tejemos uno más
01:36
tenemos 3 y cerramos
01:48
cinco cadenas uno dos tres cuatro y
01:53
cinco lazada doble
01:56
y de nuevo tenemos en el centro tres
01:59
pilares dobles sin cerrar
02:03
12 que se me abrió mucho la hebra
02:09
repetimos
02:14
12 la sala doble
02:20
dejemos el segundo pilar
02:28
y 3
02:33
cerramos
02:35
cinco cadenas
02:40
la sala doble y repetimos de nuevo en
02:43
total nos tienen que quedar ocho grupos
02:48
aquí tenemos nuestra carpeta nos tienen
02:51
que quedar 1 2 3 4 5 6 7 y 8 pétalos
02:56
separados de 5 cadenas
03:01
ya que tenemos los 8 grupos vamos a
03:03
hacer nuestras 5 cadenas
03:11
como vimos con punto deslizado
03:23
y pasamos con punto deslizado al centro
03:27
del arco donde hicimos las cinco cadenas
03:34
1
03:37
2
03:40
y tres aquí en el centro vamos a hacer
03:45
un pilar
03:46
una cadena
03:50
un pilar una cadena
03:55
y el tercer pilar en total son tres
03:57
pilares separados de una cadena
04:00
tres cadenas
04:03
tomamos hebra y en el centro
04:06
el siguiente arco repetimos tejiendo
04:11
un pilar una cadena
04:16
dos pilares una cadena
04:20
y el tercer pilar
04:23
así en cada uno de los arcos vamos a
04:26
repetir tejiendo lo mismo hasta terminar
04:29
nuestra vuelta que es la número 2
04:37
cerramos nuestra segunda vuelta con
04:40
punto deslizado
04:47
empezamos la vuelta número 3
04:51
subimos con tres cadenas
04:54
una cadena para separar tomamos hebra
05:01
tomamos hebra y entre los dos pilares en
05:04
este espacio tejemos un pilar
05:07
una cadenita de separación lazada
05:10
dejamos el pilar y entre el espacio
05:13
tejemos un pilar una cadena
05:17
tomamos hebra y sobre el pilar tejemos
05:20
un pilar en total nos tienen que quedar
05:23
cuatro pilares tres cadenas para separar
05:28
y repetimos en el siguiente motivo en el
05:31
primer pilar tejemos son pilar una
05:33
cadena para separar lazada en el espacio
05:38
tejemos un pilar
05:40
una cadena lazada dejamos un pilar en el
05:44
siguiente espacio tejemos un pilar una
05:47
cadena y en el último pilar tejemos un
05:50
pilar
05:52
de esta manera nos tiene que quedar
05:54
nuestra vuelta número 3
05:57
empezamos la vuelta número 4
06:02
tejiendo igual tres cadenitas para subir
06:06
una cadena para separar las hadas y en
06:09
cada espacio tejemos un pilar
06:13
una cadena para separar tejemos el pilar
06:17
una cadena para separar y tejemos
06:20
nuestro pilar
06:22
de una cadena y tejemos sobre el pilar
06:26
en esta vuelta
06:29
nos quedan cinco pilares
06:34
tres cadenas para separar
06:39
y de nuevo en el siguiente motivo vamos
06:41
a tejer igual
06:44
hasta terminar nuestra vuelta número 4
06:46
cerramos con punto deslizado
06:50
en la vuelta número 5 vamos a repetir lo
06:53
mismo
06:55
tres cadenas una cadena para separar y
06:59
en cada espacio tejemos un pilar
07:03
una cadena para separar
07:06
un pilar una cadena
07:09
en fila una cadena
07:14
un pilar una cadena y un pilar sobre el
07:18
pilar
07:20
tres cadenas para separar 1 2 3
07:28
y repetimos en el siguiente motivo lo
07:32
mismo que hicimos
07:34
en el primer motivo esta es la vuelta
07:36
número 5
07:40
estamos en la vuelta número 5 hasta la
07:42
vuelta numerosa y vamos a tejer igual
07:45
empiezo la vuelta 6 subiendo con 3
07:48
cadenas una cadenita para separar
07:51
tomamos hebra y de nuevo en los espacios
07:54
tejemos un pilar una cadena para separar
08:00
un pilar una cadena
08:03
y un pilar me preguntan que si los
08:05
pilares es lo mismo que vareta o punto
08:07
alto es lo mismo
08:10
una cadena un pilar una cadena
08:16
un pilar una cadena y tejemos un pilar
08:20
sobre el pilar tres cadenas
08:24
tomamos hebra y de nuevo en el siguiente
08:27
motivo repetimos así hasta terminar la
08:31
vuelta número 6
08:34
empezaremos nuestra vuelta número 7
08:36
disminuyendo cada uno de los motivos voy
08:40
a subir con 2 cadenas 1 2
08:45
tomo hebra y el pilar que voy a tejer
08:48
aquí en el espacio lo voy a tejer sin
08:51
cerrar aquí tengo los 2 y cerramos
08:54
juntos
08:55
una cadena para separar
08:58
y el espacio tejo un pilar una cadena
09:04
un pilar
09:07
una cadena
09:10
un pilar
09:11
una cadena
09:13
un pilar al llegar al último espacio
09:17
aquí vamos a disminuir el pilar que
09:20
dejamos aquí con el último de los
09:22
pilares una cadena
09:26
aquí me tome gancho tejo un pilar sin
09:28
cerrar lazada tejo el pilar el último
09:33
sin cerrar y aquí los tenemos juntos y
09:35
cerramos aquí empezamos a disminuir al
09:39
principio y al final de nuestro motivo
09:41
las cadenitas para separar
09:44
continúan siendo tres cadenitas uno dos
09:48
y tres
09:53
no son tres son cinco cadenas uno dos
09:56
tres cuatro y cinco lazada y continuamos
10:02
con el siguiente motivo un pilar sin
10:05
cerrar lazada el primero que tejemos en
10:08
el espacio también sin cerrar y cerramos
10:12
y así continuamos en cada uno de los
10:15
motivos recuerden que ahora vamos a
10:17
disminuir
10:19
cuando iniciamos el motivo y al
10:21
terminarlo separando de 5 cadenas
10:28
vuelta número 8
10:30
seguimos reduciendo vamos a hacer 2
10:34
cadenitas lazada y en el primer espacio
10:37
tejemos
10:39
otro pilar sin cerrar y cerramos
10:43
una cadenita y en cada espacio tejemos
10:47
un pilar una cadeneta
10:52
un pilar una cadena
10:56
un pilar una cadena y aquí llegamos al
11:00
último espacio hacemos un pilar sin
11:03
cerrar lazada tomamos el último que
11:07
hicimos en la vuelta anterior donde
11:09
cerramos los dos pilares juntos lo
11:12
tomamos como un pilar
11:14
y tenemos un pilar sin cerrar y cerramos
11:17
aquí se volvió a disminuir
11:27
cinco cadenas uno dos tres cuatro cinco
11:32
cadenas lazada doble
11:37
y en la cadenita del centro
11:43
tejemos un pilar
11:45
w 1 2 y 3
11:52
cinco cadenas 1 2 3 4 y 5
11:59
lazada tejemos el primer pilar sin
12:02
cerrar
12:04
el segundo sin cerrar y cerramos así
12:09
vamos a hacer
12:11
en cada vuelta
12:14
continuando disminuyendo y haciendo
12:17
nuestro pilar doble
12:20
en la vuelta anterior donde pusimos las
12:23
cinco cadenas dejamos dos cadenitas y en
12:25
la tercera es donde unimos para tejer
12:29
nuestro pilar doble
12:33
estamos en la vuelta número 1 1 2 3 4 5
12:36
6 7 y en la vuelta 8 empezaremos la
12:40
vuelta número 9
12:43
igual disminuyendo subo con dos cadenas
12:49
lazada y en el primer espacio tengo un
12:52
pilar sin cerrar y cerramos una cadena
12:55
para separar en el siguiente espacio
12:57
tejo un pilar una cadena
13:04
un pilar una cadena lazada en este
13:08
espacio tejemos un pilar sin cerrar
13:10
lazada y en el último un pilar sin
13:14
cerrar y cerramos
13:17
aquí haremos 5 cadenas 1 2 3 4 y 5 vamos
13:25
a dejar 1 2 y 3 cadenas de la vuelta
13:29
anterior y en la cuarta cadenita tejemos
13:33
un medio punto
13:36
1
13:38
en la quinta cadenita tejemos dos medios
13:42
puntos
13:43
tenemos dos en el pilar doble tejemos el
13:47
tercer medio fondo
13:51
llegamos a esta parte en la primera
13:53
cadenita tejemos
13:56
el cuarto medio punto en la segunda
13:59
cadenita tejemos
14:02
el quinto medio punto
14:06
así nos tiene que quedar
14:10
de nuevo hago cinco cadenas uno dos tres
14:14
cuatro cinco cadenas
14:23
y en el siguiente motivo tejemos lo
14:25
mismo un pilar sin cerrar
14:28
dos pilares sin cerrar y cerramos una
14:32
cadena lazada
14:35
pilar una cadena
14:39
un pilar una cadena
14:44
y al final tejemos los dos pilares en
14:47
cerrar para disminuir y cerramos
14:55
estamos en la vuelta número 9
14:59
iniciamos la vuelta número 10
15:05
disminuyendo de nuevo
15:08
hago dos cadenas como evra y el primer
15:11
espacio tejemos
15:14
un pilar sin cerrar
15:17
y cerramos
15:20
una cadena
15:22
lazada tejimos un pilar
15:27
una cadena
15:32
un pilar sin cerrar
15:35
y con el último hacemos otro espiral sin
15:37
cerrar y cerramos
15:45
hacemos cinco cadenas 1 2 3 4 5 cadenas
15:55
dejamos un medio punto y en el siguiente
15:59
hacemos
16:01
un medio punto
16:07
aquí me equivoqué
16:10
el medio punto lo vamos a hacer
16:14
en la última cadenita
16:19
hacemos un medio punto y en el primer
16:22
medio punto de la vuelta anterior
16:24
hacemos otro medio punto así aquí hago 7
16:30
cadenas 1 2 3 4 5 6 y 7 cadenitas
16:42
hacemos en el último medio punto vamos a
16:44
hacer
16:46
medio punto y en la primera cadenita
16:54
el segundo medio punto
16:57
nos tiene que quedar así
17:04
cinco cadenas
17:12
cinco cadenas y continúe tejiendo en el
17:15
siguiente motivo continuamos hasta
17:17
terminar la vuelta número diez
17:20
y empezamos nuestra vuelta número 11
17:25
aquí vamos a cerrar
17:28
12 cadenas lazadas clavó el primer
17:32
espacio tejemos un pilar sin cerrar
17:34
tenemos los dos y cerramos una cadena
17:37
para separar lazada en el siguiente
17:40
espacio
17:41
pilar se cerrar
17:43
en el último tejemos un pilar sin cerrar
17:46
y cerramos
17:48
cinco cadenas uno dos tres cuatro y
17:54
cinco cadenas
18:06
cinco cadenas en este espacio vamos a
18:10
tejer uno dos tres cuatro cinco seis y
18:15
siete pilares
18:18
después de las cinco cadenas la sala
18:21
doble
18:23
y aquí en el espacio tejemos un pilar
18:25
doble 1 2
18:30
y 3
18:32
tres cadenas para separar 1 2 3 cadenas
18:39
nasa da doble
18:41
y de nuevo en el centro tejemos un pilar
18:44
doble
18:45
y cerramos
18:50
tres cadenas
18:53
la sala doble
18:58
tejemos nuestro pilar
19:02
en total tienen que ser ocho pilares
19:04
dobles
19:07
1 2 3 4 5 6 7 y 8
19:14
cinco cadenas uno dos tres cuatro cinco
19:19
cadenas
19:22
paso al siguiente motivo tejiendo un
19:24
pilar sin cerrar en el siguiente espacio
19:28
pilar sin cerrar y aquí cerramos los dos
19:32
juntos
19:33
una cadena para separar y repetimos un
19:37
pilar sin cerrar
19:40
2 y cerramos
19:45
así vamos a hacer en cada uno de los
19:47
motivos hasta terminar esta vuelta que
19:50
es la número 11
19:52
vamos a tejer nuestra última vuelta que
19:55
es la número 12
20:11
subimos con dos cadenas uno y dos
20:16
cadenas tomamos hebra en el espacio del
20:19
centro hacemos un pilar sin cerrar
20:23
ya tenemos dos lazada en el último
20:25
tejemos uno un pilar sin cerrar y
20:28
tenemos tres y aquí cerramos todo junto
20:34
este motivo ya quedó terminado ahora
20:38
hacemos 5 cadenas
20:49
12
20:51
3
20:54
4 y 5 lazada doble y en el primer
20:59
espacio donde hicimos los ocho pilares
21:02
dobles en el primer espacio vamos a
21:05
tejer
21:07
un pilar doble
21:10
sin cerrar
21:12
hasta da doble
21:15
el segundo pilar doble sin cerrar
21:18
la sala doble y un tercer pilar doble
21:22
sin cerrar
21:25
aquí tenemos tres pilares dobles y en
21:27
cerrar y cerramos
21:30
cinco cadenas
21:33
llevo 3 4 y 5 cadenas
21:38
la sala doble y en el siguiente espacio
21:41
tejemos lo mismo tres pilares dobles
21:45
cerrados juntos
21:55
cerramos
21:57
cinco cadenas
22:02
lazada doble y de nuevo y en el
22:05
siguiente espacio
22:21
en total nos tienen que quedar 7 grupos
22:24
1 2 3 4 5 6 y 7 aquí de nuevo hago cinco
22:30
cadenas 1
22:33
2 3 4 y 5 lazadas
22:41
y dejemos un pilar sin cerrar
22:45
dos pilares sin cerrar
22:48
y tres pilares sin cerrar y cerramos
22:53
y así repetimos en cada uno de los
22:55
espacios hasta terminar nuestra vuelta
23:00
y así es como nos han quedado nuestras
23:02
carpetas amigas espero que les guste no
23:05
olviden si les gusta este vídeo darle me
23:07
gusta y compartir gracias por su
23:10
atención y nos vemos en otro vídeo
Up next
Autoplay
43:02
carpetita reilete
norma y sus tejidos
39K views
29:41
Mantel Crochet Redondo Cuadrado Rectangular paso a paso
MilArt Marroquin
256K views
18:16
Crochet motif patterns Crochet motif tablecloth Part 1
NotikaLand crochet and knitting
322K views
12:29
How to Crochet Simple Flat Flower Tutorial 100
Sheruknittingcom
Recommended for you
23:26
????? ?????? ???? ????? ????? - ????? 1 -
Crochet Samsoma
Recommended for you
16:42
????? ??? ???? ????? ?????? ????? ????? Circular crochet table doily part 1
My Accessory Box Crochet
Recommended for you
15:17
Crochet doily tutorial How to crochet doily 1-5 round Part 1
NotikaLand crochet and knitting
Recommended for you
21:03
Flower Crochet Granny Square Pattern Tutorial
MilArt Marroquin
Recommended for you
23:25
TEJE MANTEL DE LA ABUELA - CROCHET FÁCIL Y RÁPIDO - YO TEJO CON LAURA CEPEDA
Laura Cepeda
Recommended for you
21:56
carpeta de piñas a crochet
Rosa Isela
471K views
Carpeta Floral en Crochet
Rosa Isela
170K views
Carpeta de corazones
Rosa Isela
70K views
Camino de mesa con piñas
Rosa Isela
426K views
mantel a crochet (parte 1)
norma y sus tejidos
257K views
Como aprender a tejer carpeta, tapete, portavasos fácil paso a paso
Norma Flores
356K views
Hexágono con pétalos puff
Rosa Isela
90K views
Como hacer tapete o carpeta a crochet paso a paso DIY parte 1/2
Norma Flores
400K views
carpeta tejida a gancho ( motivo para blusón )
Rosa Isela
131K views
Mantelito cuadrado de piñas
Rosa Isela
73K views
Como hacer un tapete facil de hacer (En español)
Fresiitah17
1.4M views
Carpeta con rombos.
415,857 views
4.8K
321
Share
Rosa Isela
Published on Mar 19, 2017
carpeta tejida en algodon numero 10 y gancho de metal # 2.25 mm
114 Comments
Default profile photo
Add a public comment...
Telefono De Prueba
Telefono De Prueba
11 months ago
hola muy linda la carpeta pero puedes explicar un poco mas despacio x fa, grax x compartir tus trabajos, saludos desde veracruz mexico?
7
Silvia Maria
Silvia Maria
1 year ago
muito obrigado?
1
Leticia Gonzalez
Leticia Gonzalez
1 year ago
este hermosa?
1
petis munos dias
1 year ago
hola rosa te quiero felisitar por tu trabajo lo haces muy bien solo que para mi tejes muy rapido pero de hai en fuera eres muy buena te felizito y me despido yo ya lo logre hacer cuidate sigue asi?
2
susana gallardo
1 year ago
Linda carpeta y muy rápida, ya la terminé, gracias, saludos.?
11
Bersellay Cardona
11 months ago
buenas; está hermosa y se ve fácil pero si podrías hacerlo más despacio sería mucho mejor.Gracias?
2
Jeannette Del Pilar Garrido Dominguez
1 year ago
Está lindo?
2
Nancy Garcés
1 year ago
muy linda carpeta ,gracias por compartir?
2
???? ??????
1 year ago
please can you write the description in English?
1
Martha Sanchez
1 year ago
hola rosa esta preciosa la carpeta mañana la voy a empezar a tejer gracias por compartir tus hermosos tejidos?
1
Darwin Quijada
1 year ago
Muy linda y facil de hacer.?
1
Maria Merino
1 year ago
megusta?
1
Norma Alvarez
1 year ago
Hola,están preciosas la carpeta y rápido gracias?
1
Cristina Soares
1 year ago
muito lindo..
pode fazer em linha mais grossa para colocar debaixo de pratos??
1
Ana Vargas
1 year ago
'?
1
Silvia Patricia
1 year ago
muy bonita m gusta?
1
Matilde Zacarias
1 year ago
hola Rosa, hermosa la carpeta adoro las carpetas, muchas gracias x la enseñanza saludos?
nany castillo
1 year ago
BUENOS DIAS SRA ROSA MUY LINDO EL TAPETITO BESITOS?
Tito Juan Albares
1 year ago
Q hermosura de carpeta es excelente en sus labores bendiciones?
Socorro Ortega
1 year ago
Muy bonita y facil Cuidate amiguita.?
EOD;
*/

$str = $_POST['yttext'];

$str = str_replace(chr(13), '', $str);
$arr = explode($lf, $str);
while ($arr[0] <> 'Transcript')
	array_shift($arr);
array_shift($arr);
$i = 0;
while ($arr[$i] <> 'Up next' && $arr[$i+1] <> 'Autoplay')
	$i++;
$arr = array_slice($arr, 0, $i);
//echo print_r($arr, true);
$content = '';
$lines = count($arr);
for ($i=0; $i < $lines; $i += 2) {
	$content .= ($i/2+1) . $lf . get_time_str($arr[$i]) . ' --> ' . (($i+2 == $lines) ? '' : get_time_str($arr[$i+2])) . $lf .$arr[$i+1] . $lf . $lf;
}
echo $content;

function get_time_str($tstr) {
	if (!(strlen($tstr) > 5))
		$tstr = '00:' . $tstr;
	return $tstr;
}
