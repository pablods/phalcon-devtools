<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 7/14/15
 * Time: 7:27 PM
 */

namespace Phalcon\Mvc\Model;


class Column extends \Phalcon\Db\Column{


    protected $_default;
    protected $_mysqlType;

    function __construct($columnName, $definition) {
        if(isset($definition['default'])){
            $this->_default = $definition['default'];
        }

        if(isset($definition['mysql_type'])){
            $this->_mysqlType = $definition['mysql_type'];
        }
        parent::__construct($columnName, $definition);
    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->_default;
    }

    /**
     * @return mixed
     */
    public function getMysqlType()
    {
        return $this->_mysqlType;
    }

}