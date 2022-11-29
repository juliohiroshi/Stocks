<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dividendos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Barra de navegação -->
    <div class="nav">
        <div class="left"><a href="index.php">Back</a></div>
        <div class="center">Dividendos</div>
        <div class="right"><a href="help.php">Ajuda</a></div>
    </div>

    <!-- Pega os dados enviados pelo método GET -->
    <h1 class="title">
            <?php 
                $ticker = $_GET['symbol'];
                $name = $_GET['name'];
                echo($name);
            ?>
    </h1>

    <!-- Usa os dados passados para ver os dividendos de determinada empresa -->
    <div class="table_space">
        <table>
            <th>Data com</th>
            <th>Data pagamento</th>
            <th>Valor($)</th>
                <?php
                    include_once('api.php');
                    $API = new API_ALETHEIA();
                    $dados_dividendos = $API->busca_dividendo($ticker);
                    if($dados_dividendos != false){
                        $cont = 0;
                        foreach($dados_dividendos as $dividendo){
                            echo("<tr>");
                            //Formata os dados e os escreve
                            echo("<td>".str_replace('T00:00:00', '', $dividendo['PeriodStart'])."</td>");
                            echo("<td>".str_replace('T00:00:00', '', $dividendo['PeriodEnd'])."</td>");
                            //Verifica se o valor está na casa dos bilhões ou milhões>
                            if($dividendo['Value']/1000000000 >= 1){
                                $bidividendo = $dividendo['Value']/1000000000;
                                echo("<td>".number_format($bidividendo, 3, '.', null)."B</td>");
                            }else{
                                $midividendo = $dividendo['Value']/1000000;
                                echo("<td>".number_format($midividendo, 3, '.', null)."M</td>");
                            }
                            
                            echo("</tr>");
                            $cont++;
                        }
                    }
                ?>
        </table>
    </div>
</body>
</html>