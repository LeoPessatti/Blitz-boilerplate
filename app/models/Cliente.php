<?php

namespace blitz\app\models;
/**
 * Description of Cliente
 *
 * @author Fernando Batels <luisfbatels@gmail.com>
 */
class Cliente extends \blitz\vendor\core\ModelDatabase{
    
    protected function nameTable() {
        return 'noticias';
    }
    public function __construct() {
        parent::__construct();
        $this->writePrivateFile('text', 'dsda',true);
    }
}
