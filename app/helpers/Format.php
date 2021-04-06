<?php

/*
 * This file is part of the Blitz package.
 *
 * (c) 2016 Fernando Batels
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace blitz\app\helpers;

/**
 * Helper contendo formatações.
 *
 * @author Fernando Batels <luisfbatels@gmail.com>
 * @author Leonardo Pessatti <lpessatti@gmail.com>
 */
class Format extends \blitz\vendor\core\Helpers {

   /**
     * Formata números para obedecer o padrão monetário escolhido.
     * O segundo parâmetro é opcional e serve para escolher o tipo de formatação assumido pelos pontos e vírgulas. 
     * Se deixado vazio, exibirá em pt_BR.
     * O terceiro parâmetro é opcional e serve para escolher o tipo de moeda. 
     * Se deixado vazio, exibirá em BRL.
     * 
     * @param type $total
     * @param type $lang
     * @param type $moeda
     * @return string
     */
    public static function moeda($total, $lang = 'pt_BR', $moeda = 'BRL') {
         if (empty($total)) {
            return 'R$ 0,00';
        }
        $formatter = new \NumberFormatter($lang, \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency((float)$total, $moeda) . PHP_EOL;
    }

    /**
     * Formata números para obedecer o padrão de data escolhido.
     * O segundo parâmetro é opcional e serve para escolher o tipo de data. Se deixado vazio, 
     * exibirá no padrão brasileiro dia/mes/ano hr:min:seg.
     * 
     * @param type $data
     * @param type $formato
     * @return string
     */
    public static function data($data, $formato = 'd/m/Y H:i:s') {
        if (!empty($data)) {
            $data = new \DateTime($data);
            $data = $data->format($formato);
        } else {
            $data = '--';
        }
        return $data;
    }
   
/**
 * Formata um número para usar o ponto como separador de milhar e vírgula como separador
 * de decimais. Permite ainda decidir quantas casas decimais haverá.
 * 
 * @param type $numero
 * @param type $casaDec
 * @return string
 */
    public static function numeral($numero, $casaDec = 2) {
        if (!empty($numero)) {
            $numero = number_format ( $numero , $casaDec , ',' , '.' );
        } else {
            $numero = '0';
        }
        return $numero;
    }
   
    /**
     * Arredonda o número e substitui os zeros pelo número extenso.
     * 
     * Copiado de http://php.net/manual/pt_BR/function.number-format.php 
     * by james at bandit.co.nz
     * @param type $numero
     * @return boolean
     */
    public static function numeralLegivel($numero) {
        // first strip any formatting;
        $numero = (0+str_replace(",","",$numero));
        // is this a number?
        if(!is_numeric($numero)) return false;
        // now filter it;
        if($numero>1000000000000) return round(($numero/1000000000000),1).' trilhões';
        else if($numero>1000000000) return round(($numero/1000000000),1).' bilhões';
        else if($numero>1000000) return round(($numero/1000000),1).' milhões';
        else if($numero>1000) return round(($numero/1000),1).' mil';
       
        return number_format($numero);
    }


    /**
     * Retorna a string do status da loja conforme o código do mesmo
     *
     */
    public static function statusLoja($status) {
        //DM_LOJA_STATUS is '0 => Indisponivel | 1 => Habilitado | 2 => Modo Testes | 3 => Restrito Autorizaçao | 4 => Modo Garçom | 5 => Garçom em Testes';
        switch ($status) {
           case 0:
                return 'Indisponível';
           case 1:
                return 'Habilitada';
           case 2:
                return 'Testes';
        }

        return 'Desconhecido';
    }


    /**
     * Retorna a string do status app 
     */
    public static function statusApp($status) {
        return $status == 1 ? 'Disponível' : 'Indisponível';
    }

    /**
     * Retorna a string html do status app 
     */
    public static function statusAppHtml($status) {
        return $status == 1 ? '<span class="label label-success">Disponível</span>' : '<span class="label label-danger">Indisponível</span>';
    }


    /**
     * Retorna a url completa da imagem para ser usada em tags como a img
     */
    public static function buildUrlImage($imagem) {

        if (!empty($imagem)) {
            return 'http://' . \blitz\app\helpers\Upload::$hostCapp . ':22331/imagens/' . $imagem;
        }
    
        return null;
    }

    /**
    * Retorna o nome do dia da semana conforme o número
    *
    * @param $dia - Dia desejado, começando em 0 = Domingo
    */
    public static function diaSemana($dia) {
        $diaSemana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
        
        return $diaSemana[$dia];
    }
}
