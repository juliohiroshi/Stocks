<?php
    require_once 'api.php';
    $aletheia_api = new API_ALETHEIA();
    
    //Lista de ativos
    $mystocks = array(
        "TSLA",
        "MSFT",
        "AAPL",
        "AMZN",
        "AMD",
        "NVDA",
        "BA",
        "KO",
    );
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stocks</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<body>
<div class="nav">
        <div class="left"><button onclick="trocacor()" class="trocacor">Troca cor</button></div>
        <div class="center">Minha carteira</div>
        <div class="right"><a href="help.php">Ajuda</a></div>
    </div>
    
    <!-- Local onde esses ativos serão exibido -->
    <div class="stock_place">
            <?php
            //Para cada item na lista, busca os dados e cria o stock
                foreach($mystocks as $stock){
                    $dados_api = $aletheia_api->busca_dados($stock);
                    if($dados_api != false){
                        echo("<a href='dividendos.php?symbol=$stock&name=$dados_api[3]'>");
                        echo("<div class='stock'> ");
                        echo("<div class='stock_top'>");
                        echo("<div class='stock_name'>$dados_api[0]</div>");

                        $percent = round($dados_api[2] * 100, 2);
                        if($percent>=0){
                            echo("<div class='stock_change' style='color: darkgreen'>$percent%</div>");
                        }else{
                            echo("<div class='stock_change' style='color: darkred'>$percent%</div>");
                        }
                        
                        echo("</div>");
                        
                        echo("<div class='stock_price'>$".number_format($dados_api[1], 2, '.', null)."</div>");
                        
                        echo("</div>");
                        echo("</a>");
                    }
                }
            ?>
    </div>

    <script>
        $cont=0;
        function trocacor(){
            if($cont==0){
                document.body.style.setProperty('--navfontcolor', 'white');
                document.body.style.setProperty('--navbackground', 'black');
            }else if($cont >= 1){
                document.body.style.setProperty('--navfontcolor', 'black');
                document.body.style.setProperty('--navbackground', 'rgb(224, 204, 149)');
                $cont=-1;
            }
            $cont++;
            console.log($cont);
        }
    </script>
</body>
</html>