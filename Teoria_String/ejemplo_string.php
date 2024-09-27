<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplos de string</title>
</head>
<body>
   <?php
   $texto1 ="Me llamo Juan";
   //se puede acceder a cada string como un array de caracteres
   echo "<p>".$texto1[6]."</p>";

   //para saber la longiud de la cadena usamos strlen
   echo "<p>".strlen($texto1)."</p>";

   echo "<p>".strtolower($texto1)."</p>";//minúsculas
   echo "<p>".strtoupper($texto1)."</p>";//mayusculas
   echo "<p>".substr($texto1,3,5)."</p>";//mejor ponerle donde empezar y cuantos queremos



   /*
   devuelve un array donde cada elemento del mismo es
   una subcadena que procede de separar el texto
   indicado en base a su delimitador.

   explode(
    delimitador,
    texto
    [limite]
   )
    //une todos los elementos del array para
    //formar un texto
   implode(array);

   trim(texto,[caracteres]);

   str_word_count(
texto
[,formato
[,listaCaracteres]]
)

substr(texto, posInicial
[,tamaño])
   */
   ?>
</body>
</html>