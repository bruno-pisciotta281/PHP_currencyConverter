<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Resposta</title>
</head>
<body>
    <main>
        <h1>Resultado!</h1>
        <?php 

        $inicio = date("m-d-Y", strtotime("-7 days"));
        $fim = date("m-d-Y");
        $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''. $inicio .'\'&@dataFinalCotacao=\''. $fim .'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
        $dados = json_decode(file_get_contents($url), true);
        $cotação = $dados["value"][0]["cotacaoCompra"];
        
        $real = $_GET["din"] ?? 0;
        $dolar = $real / $cotação;
        $padrão = numfmt_create("pt-br", NumberFormatter::CURRENCY);
        echo "Seus " . numfmt_format_currency($padrão, $real, "BRL") . " equivalem a " . numfmt_format_currency($padrão, $dolar, "USD");
        
        ?>
        <br>
        <p>Valores atualizados em tempo real de acordo com o <strong>Banco Central</strong></p>
    <a href="index.html"><button>Voltar</button></a>
    </main>
</body>
</html>