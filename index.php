
<?php
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inteligência Artificial</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
';

echo '
    <div class="jumbotron text-center">
    <h1>Inteligência artificial</h1>
    <p>Redes Neurais Artificiais utilizando Hopfield</p> 
    </div>
';

echo '
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
            <h4 style="margin-bottom: -10px;"><b>Matriz</b></h3><br>
';

//Caracteres
$p1 = array(1, 1, 1, 1, 1, -1, -1, -1, -1, -1, 1, 1, -1, 1, 1, 1, 1, -1, -1, -1, -1, -1, 1, 1, 1, 1, 1, 1, 1, -1);
$p2 = array(1, 1, -1, -1, 1, 1, 1, 1, -1, -1, 1, 1, 1, 1, 1, 1, 1, 1, -1, -1, -1, -1, 1, 1, -1, -1, -1, -1, 1, 1);
$p3 = array(-1, -1, 1, 1, -1, -1, -1, 1, 1, 1, -1, -1, -1, -1, 1, 1, -1, -1, -1, -1, 1, 1, -1, -1, -1, 1, 1, 1, 1, -1);
$p4 = array(-1, 1, 1, 1, 1, -1, 1, 1, -1, -1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, -1, -1, 1, 1, -1, 1, 1, 1, 1, -1);
$p5 = array(1, 1, 1, 1, 1, 1, -1, -1, 1, 1, -1, -1, -1, -1, 1, 1, -1, -1, -1, -1, 1, 1, -1, -1, -1, -1, 1, 1, -1, -1);
$p6 = array(1, 1, -1, -1, -1, -1, 1, 1, -1, -1, -1, -1, 1, 1, -1, -1, -1, -1, 1, 1, -1, -1, -1, -1, 1, 1, 1, 1, 1, 1);
$p7 = array(-1, -1, 1, 1, -1, -1, -1, -1, 1, 1, -1, -1, -1, 1, 1, 1, 1, -1, 1, 1, -1, -1, 1, 1, 1, 1, 1, 1, 1, 1);

//Ruído
$x = array(1, 1, 1, 1, 1, -1,  -1, -1, -1, -1, -1, -1,  -1, 1, 1, 1, -1, -1,  -1, -1, -1, -1, -1, -1,  1, 1, -1, 1, 1, -1);

//Peso
$w = array();
$qtde = 30;

//Montar a Matriz 
echo '<table><tbody>';
for ($i = 0; $i < $qtde; $i++) {
    echo '<tr>';
        for ($y = 0; $y < $qtde; $y++) {
            if ($i == $y) {
                $w[$i][$y] = 0;
            } else {
                $w[$i][$y] = ($p1[$i] * $p1[$y]) + ($p2[$i] * $p2[$y]) + ($p3[$i] * $p3[$y]) + ($p4[$i] * $p4[$y]) + ($p5[$i] * $p5[$y]) + ($p6[$i] * $p6[$y]) + ($p7[$i] * $p7[$y]);
            }
            
            echo '<td style="border: 1px solid grey; padding: 10px;">'.$w[$i][$y].'</td>';
        }
    echo '<tr>';
}
echo '</tbody></table></br>';

//Padrão desconhecido
$y = array();

//Atribuir valor 0 aos itens da matriz y
for ($i = 0; $i < $qtde; $i++) {
    $y[$i] = 0;
}

//Montar vetor y
for ($i = 0; $i < $qtde; $i++) {
    
    foreach ($x as $key => $value) {
        $y[$i] += $value * $w[$key][$i];
    }
    
    //Função Degrau
    if ($y[$i] > 0) {
        $y[$i] = 1;
    } else if ($y[$i] < 0) {
        $y[$i] = -1;
    }
}

echo '<h4 style="margin-bottom: -10px;"><b>Resultados</b></h3><br>';
function converge($y, $p, $i){
    $resultado = 0;

    foreach($y as $key => $value){
        if($y[$key] == $p[$key] ){
            $resultado++;
        }
    }
    
    $resultado = ((100 * $resultado) / 30);

        echo '<b>Padrão '.$i.': </b>'.number_format($resultado, 2).'% </br>';
}

echo '<div class="card" style="margin-bottom: 15px;">
<div class="card-body">';
converge($y, $p1, 1);
converge($y, $p2, 2);
converge($y, $p3, 3);
converge($y, $p4, 4);
converge($y, $p5, 5);
converge($y, $p6, 6);
converge($y, $p7, 7);

echo '</div></div>';

echo '</div></div></body></html>';