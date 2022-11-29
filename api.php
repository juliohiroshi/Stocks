<?php
    class API_ALETHEIA {
        //Retorna os dados de um determinado ativo 
        function request($stock){
            $stock_symbol = "$stock";
            $url = "https://api.aletheiaapi.com/StockData?key=524D6CD923694CC98FE09E4A62687EDA&symbol=".
            $stock_symbol."&summary=true";
            $response = @file_get_contents($url);
            return json_decode($response, true);
        }

        //Ao requisitar os dados da função "request()", coloca os dados em um array e os retorna
        function busca_dados($stock){
            $data = $this->request($stock);

            if(!empty($data)){
                $dadosRelevantes = array(
                    $data['Symbol'],
                    $data['Summary']['Price'],
                    $data['Summary']['PercentChange'],
                    $data['Summary']['Name'],
            );
                return $dadosRelevantes;
            }else{
                return false;
            }
        }

        //Retorna os dados de dividendo de uma empresa
        function requestdividendo($symbol){
            $stock_symbol = "$symbol";
            $url = "https://api.aletheiaapi.com/FinancialFactTrend?id=".$stock_symbol.
            "&label=0&period=0&key=524D6CD923694CC98FE09E4A62687EDA";
            $response = @file_get_contents($url);
            return json_decode($response, true);
        }
        
        //Consegue os dados da função requestdividendo() de uma ação e os retorna.
        function busca_dividendo($symbol){
            $data = $this->requestdividendo($symbol);
            
            if(!empty($data)){
                return $data;
            }
        }
    }
?>