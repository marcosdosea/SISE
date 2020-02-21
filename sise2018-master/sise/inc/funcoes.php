<?php
/**
 * Autor: Daniel Lima
 * Date: 10/03/2017
 */

//Criptografa a senha
function criptografaSenha($senha){
    return md5(sha1(md5($senha)));
}

//Essa função gera um valor de String aleatório do tamanho recebendo por parametros
function randString($size){

    $basic = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    $return = "";

    for ($count = 0; $size > $count; $count++) {
        $return .= $basic[rand(0, strlen($basic) - 1)];
    }

    return $return;
}

function removerAcentos($string, $slug = false){
    $string = strtolower($string);
    // Código ASCII das vogais
    $ascii['a'] = range(224, 230);
    $ascii['e'] = range(232, 235);
    $ascii['i'] = range(236, 239);
    $ascii['o'] = array_merge(range(242, 246), array(240, 248));
    $ascii['u'] = range(249, 252);
    // Código ASCII dos outros caracteres
    $ascii['b'] = array(223);
    $ascii['c'] = array(231);
    $ascii['d'] = array(208);
    $ascii['n'] = array(241);
    $ascii['y'] = array(253, 255);
    foreach ($ascii as $key => $item) {
        $acentos = '';
        foreach ($item AS $codigo) $acentos .= chr($codigo);
        $troca[$key] = '/[' . $acentos . ']/i';
    }
    $string = preg_replace(array_values($troca), array_keys($troca), $string);
    // Slug?
    if ($slug) {
        // Troca tudo que não for letra ou número por um caractere ($slug)
        $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
        // Tira os caracteres ($slug) repetidos
        $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
        $string = trim($string, $slug);
    }
    return $string;
}

function modalSucesso($mensagem){
    return "<div class='modal modal-success' id='myModal'>
          <div class='modal-dialog'>
            <div class='modal-content'>
              <div class='modal-header''>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                  <span aria-hidden='true'>×</span></button>
                <h4 class='modal-title'>{$mensagem}</h4>
              </div>
            </div>
          </div>
        </div>";
}
//Função que retorna a frequencia total do usuário. 0 = 0% e 1 = 100%
function frequenciaEvento($quantDias,$listaFrequenciaUsuarioPorDia,$listaInformacaoFrequenciaPorDia){
    $frequencia = 0;
    for($i = 0; $i < $quantDias; $i++){
        $frequencia += $listaFrequenciaUsuarioPorDia[$i]/$listaInformacaoFrequenciaPorDia[$i];
    }
    if($frequencia/$quantDias > 1){
        return 1;
    }else{
        return $frequencia/$quantDias;
    }
}

// Funcao que recebe uma data e fragmenta em -> [ANO] , [MES] , [DIA]
function fragmentarData($data){
    $arrayData = array();
    $dataInicial = explode('-', $data);
    array_push($arrayData,$dataInicial[0]);// posição [0] relativo a ano
    array_push($arrayData,$dataInicial[1]);// posição [1] relativo a mes
    $diaMesInicial = explode(' ', $dataInicial[2]);
    $diaMesInicial = $diaMesInicial[0];
    array_push($arrayData,$diaMesInicial);//relativo a dia

    return $arrayData;
}

// Funcao que recebe duas datas, trata e retorna a string relativa ao periodo para escrever no certificado
function montarTextoPeriodoCertificado($arrayDataIni, $arrayDataFin){
    $textoFinal = "";
    $dataIni = $arrayDataIni[0] . '-' . $arrayDataIni[1] . '-' . $arrayDataIni[2];
    $dataFin = $arrayDataFin[0] . '-' . $arrayDataFin[1] . '-' . $arrayDataFin[2];

    //  var_dump($arrayDataIni[1]);
    //  var_dump($arrayDataFin[1]);

    // Fez-se necessario a fragmentação da data, pois quando ultilizada de Modo $dataIni sem explode
    // a posição [0] era apenas o 1° caractere do Ano e não o Ano completo
    // $dataIni = explode('-', $dataIni);
    // $dataFin = explode('-', $dataFin);

    $anoIni = $arrayDataIni[0];
    // $mesIni = $arrayDataIni[1];
    $diaIni = $arrayDataIni[2];

    $anoFin = $arrayDataFin[0];
    // $mesFin = $arrayDataFin[1];
    $diaFin = $arrayDataFin[2];


    // Escrever o mes por extenso (nativamente vem em ingles)
    setlocale(LC_TIME, 'portuguese'); // Seta o texto em portugues
    date_default_timezone_set('America/Sao_Paulo');
    $mesIni = strtoupper(strftime("%B", strtotime($dataIni)));

    //var_dump($mesIni);
    $mesFin = strtoupper(strftime("%B", strtotime($dataFin)));
    //var_dump($mesFin);

    // Testando os casos para adaptar o melhor texto pra cada situação
    // Tendo em vista que, as posições referidas [0] = ANO. [1] = MES, [2] = DIA


    if ($anoIni == $anoFin && $mesIni == $mesFin && $diaIni == $diaFin) {
        $mesFin = strtoupper(strftime("%B", strtotime($dataFin)));
        // Caso os dias forem Iguais
        // Dias iguais;
        $textoFinal = "em $diaIni de $mesIni de $anoIni";
       // var_dump($textoFinal);

    } elseif ($mesIni == $mesFin && $anoIni == $anoFin) {
        // Meses iguais, anos iguais;
        $textoFinal = "no periodo de $diaIni até $diaFin de $mesIni de $anoIni";
       // var_dump($textoFinal);

    } elseif ($mesIni == $mesFin && $anoIni != $anoFin) {
        // Meses iguais, anos diferentes;
        $textoFinal = "no periodo de $diaIni de $mesIni de $anoIni até $diaFin de $mesFin de $anoFin";
       // var_dump($textoFinal);

    } elseif ($mesIni != $mesFin && $anoIni == $anoFin) {
        // Meses diferentes, anos iguais;
        $textoFinal = "durante o periodo de $diaIni de $mesIni a $diaFin de $mesFin de $anoFin";
       // var_dump($textoFinal);

    } elseif ($mesIni != $mesFin && $anoIni != $anoFin) {
        // Meses diferentes, anos diferentes;
        $textoFinal = "durante o periodo de $diaIni de $mesIni de $anoIni até $diaFin de $mesFin de $anoFin";
        //var_dump($textoFinal);
    }
    return $textoFinal;
}

function dataExtenso($dia, $dataIni, $dataFinal, $diasFrequencia){
        /*$dataInicial = explode('-', $dataIni);
        $anoInicial = $dataInicial[0];
        $mesInicial = $dataInicial[1];
        $diaMesInicial = explode(' ', $dataInicial[2]);
        $diaMesInicial = $diaMesInicial[0];


        echo "Data Completa Inicial -> "; var_dump($dataInicial); echo "<br>";
        echo "Dia Inicial -> "; var_dump($diaMesInicial);  echo "<br>";
        echo "Mes Inicial -> "; var_dump($mesInicial);  echo "<br>";
        echo "ANo Inicial -> "; var_dump($anoInicial);  echo "<br>";
    */
        $dataInicial = fragmentarData($dataIni);
        // var_dump($dataInicial);
        $dataFinal = fragmentarData($dataFinal);
        //var_dump($dataFinal);

        foreach ($dia as $dialinha) {
            $dataInicial = fragmentarData($dialinha);
            var_dump($dataInicial);
        }
        /* echo "<br> =============  <br> ";

         $dataFinal = explode('-', $dataFinal);
         $anoFinal = $dataFinal[0];
         $mesFinal = $dataFinal[1];
         $diaMesFinal = explode(' ', $dataFinal[2]);
         $diaMesFinal = $diaMesFinal[0];

         echo "<br> =============  <br> ";

         echo "Data Inicial Final -> "; var_dump($dataFinal); echo "<br>";
         echo "Dia Final -> "; var_dump($diaMesFinal);  echo "<br>";
         echo "Mes Final -> "; var_dump($mesFinal);  echo "<br>";
         echo "ANo Final -> "; var_dump($anoFinal);  echo "<br>";

         echo "<br> =============  <br> ";
         print_r($dia);*/
        /*$textoCertificado = 'Certificamos que ' . $nome . ' portador do CPF.: ' . $usuario->getCpfUsuario() . ' participou do evento realizado em ' . $evento->getIdEndereco() . ' nos período de $periodoUsuario qualidade de ' . $usuario->getTipoUsuario() . ' com frequência de  $frequenciaUsuario horas.';
        */

}

function redimensionarImagem($imagem, $pasta){
    // Pastas é para saber se é Certificado, Eventos, Sise ou Usuarios
    // Para fazer o acesso a arquitetura das pastas
    $caminhoImagem = 'imagens/'.$pasta.'/'.$imagem;

    // Variavel de imagem temporaria, que fará as operações de conversao.
    $img = imagecreatefromjpeg($caminhoImagem);

    // Cria Variaveis com os tamanhos da imagem. Largura e altura respectivamente.
    list($larg, $alt) = getimagesize($caminhoImagem);

    // Switch para adequar o tamanho da imagem as especificações de cada finalidade.
    switch ($pasta){
        case 'certificados':
            $larguraFormatada = 350;
            $alturaFormatada = 100;
            echo " ====== Switch certificados ======";
            break;

        case 'eventos':
            $larguraFormatada = 340;
            $alturaFormatada = 210;
            echo " ====== Switch EVENTOS ======";
            break;

        case 'usuarios':
            $larguraFormatada = 60;
            $alturaFormatada = 100;
            echo " ====== Switch Usuarios ======";
            break;

        case 'sise':
            echo " ====== Switch sise ======";
            $larguraFormatada = 10;
            $alturaFormatada = 10;
            break;

        default: echo "default";
    }

    // cria uma nova img em branco.
    $novaImagem = imagecreatetruecolor($larguraFormatada, $alturaFormatada);

    // Temos que copiar a imagem original para a nova imagem com o novo tamanho, para isso utilizamos a função imagecopyresampled
    imagecopyresampled($novaImagem, $img, 0,0,0,0,
        $larguraFormatada, $alturaFormatada, $larg, $alt);

    // Cria a imagem ja redimensionada e com a mesma qualidade da original.
    $novoNome = 'new'.$imagem;
    $teste = imagejpeg($novaImagem, 'imagens/'.$pasta.'/'.$novoNome, 100);

    if($teste == true){
//        unlink($caminhoImagem);
        echo "\naqui deleta\n";
    }

    // Destroi as imagens temporarias que foram criadas.
    imagedestroy($img);
    imagedestroy($novaImagem);

    // Retorna o diretorio da nova img
    $retorno = 'imagens/'.$pasta.'/'.$novoNome;
//    var_dump($retorno);
    return $retorno;
}
?>