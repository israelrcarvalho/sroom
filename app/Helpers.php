<?php


use Illuminate\Support\Facades\DB;


if (!function_exists('checked')) {
    function checked($value)
    {
        return $value ? 'checked' : '';
    }
}


if (!function_exists('iRcGetSysValArray')) {
    /**
     * @string $title
     * @return Retorna um array
     */
    function iRcGetSysValArray($title)
    {
        $sql = DB::table('configsys as c')->select('c.nome', 'c.valor')->where('c.nome', '=', $title)->get();

        $sep1 = null;
        $sep2 = '|';

        if (!isset($sep1))
            $sep1 = "\n";
        if ($sep1 == "\\n")
            $sep1 = "\n";
        if ($sep1 == "\\r")
            $sep1 = "\r";

        $temp = explode($sep1, $sql[0]->valor);
        $arr = array();
        foreach ($temp as $item) {
            if ($item) {
                $temp2 = explode($sep2, $item);
                if (isset($temp2[1])) {
                    $arr[trim($temp2[0])] = $temp2[1];
                } else {
                    $arr[trim($temp2[0])] = $temp2[0];
                }
            }
        }
        return $arr;
    }
}

/**
 * @param $title valor da chave da tabela config
 * @param $result String retornado que deseja converter
 * @return String já convertido
 */
function iRcGetSysVal_($title, $result)
{
    if (isset($result)) {

        $sql = DB::table('configsys as c')->select('c.nome', 'c.valor')->where('c.nome', '=', $title)->get();

        $sep1 = null;
        $sep2 = '|';

        if (!isset($sep1))
            $sep1 = "\n";
        if ($sep1 == "\\n")
            $sep1 = "\n";
        if ($sep1 == "\\r")
            $sep1 = "\r";

        $temp = explode($sep1, $sql[0]->valor);
        $arr = array();
        foreach ($temp as $item) {
            if ($item) {
                $temp2 = explode($sep2, $item);
                if (isset($temp2[1])) {
                    $arr[trim($temp2[0])] = $temp2[1];
                } else {
                    $arr[trim($temp2[0])] = $temp2[0];
                }
            }
        }
        return $arr[$result];
    } else return "0"; // "Não Informado";
}

function listaItens($title, $textoInicial = NULL)
{
    $sql = DB::table('configsys as c')->select('c.nome', 'c.valor')->where('c.nome', '=', $title)->get();

    $sep1 = null;
    $sep2 = '|';

    if (!isset($sep1))
        $sep1 = "\n";
    if ($sep1 == "\\n")
        $sep1 = "\n";
    if ($sep1 == "\\r")
        $sep1 = "\r";

    $temp = explode($sep1, $sql[0]->valor);
    $arr = array();
    foreach ($temp as $item) {

        if ($item) {
            $temp2 = explode($sep2, $item);

            if (isset($temp2[1])) {
                $arr[trim($temp2[0])] = $temp2[1];
            } else {
                $arr[trim($temp2[0])] = $temp2[0];
            }
        }
    }
    if ($textoInicial != NULL) {
        $arr = array('' => $textoInicial) + $arr;
    }

    return $arr;
}

/**
 * @param $data_mysql valor da data recebido do banco de dados
 * @return String já convertido para formato que será apresentado na view
 */
function dataSQLtoPTbr($data_mysql = null)
{
    if (is_null($data_mysql)) {
        // $data = "2016-12-03 10:00:00";
        $data = date('Y-m-d');
    } else {
        $data = $data_mysql;
    }

    return date('d-m-Y', strtotime($data));
}

/**
 * @param $data recebe valor da data via formulário
 * @param $auxdata transforma $data no formato para ser enviado ao banco de dados
 * @return String que será gravada no banco de dados
 */
function dataPTbrToDb($data)
{
    $auxdata = strtotime($data);
    return date('Y-m-d H:i:s', $auxdata);
    //2016-02-23 20:02:46
}

function totalDias($recebeDataInicial, $recebeDataFinal)
{

    $dataInicial = new DateTime($recebeDataInicial);
    $dataFinal = new DateTime($recebeDataFinal);

    $totalDias = $dataInicial->diff($dataFinal);

    return $totalDias->days;

}

function adicionaDia($dataBanco, $qtd)
{

    $resultado = date('Y-m-d', strtotime('+' . $qtd . ' days', strtotime($dataBanco)));
    return $resultado;

}

function nameOfDay($date)
{

    setlocale(LC_ALL, "pt_BR.UTF-8", "ptb");
    return strftime("%A", strtotime($date));

}

function removeRetorno($input)
{

    return preg_replace("/\n|\r|\t/", "", $input);

}

/**
 * Converte um valor em reais, para formato decimal do MySQL
 *
 * @param string $valor Valor em reais
 * @return float Valor em decimal
 */
if (!function_exists('reaisParaDecimal')) {

    function reaisParaDecimal($valor)
    {
        return str_replace(array('.', ','), array('', '.'), $valor);
    }
}

    function formatNumber($string){
        number_format($string, 2, ',', '.');
    }



if (!function_exists('dataPorExtenso')) {

    function dataPorExtenso($date)
    {
        setlocale(LC_ALL, "pt_BR.UTF-8", "ptb");
        // setlocale(LC_ALL, "pt_BR.utf-8", "ptb");
        return strftime("%d de %B de %Y", strtotime($date));
    }
}


//function arraySelectOptiongroup($arr)
//{
//    $i = 0;
//    foreach ($arr as $x) {
//      //  $arr[$i]['id'] = $x->id;
//        $arr[$i]['nome'] = $x->nome;
//        $arr[$i]['nivel_tipo'] = $x->nivel_tipo;
//        $arr_[] = $x->nivel_tipo;
//        $i++;
//    }
//
//    $novo = array();
//    foreach ($arr as $k => $v) {
//        $novo[iRcGetSysVal_('TIPO_NIVEL', $v['nivel_tipo'])][$v['id']] = $v['nome'];
//    }
//
//}


