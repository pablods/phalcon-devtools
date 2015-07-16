<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 7/14/15
 * Time: 7:27 PM
 */

namespace Phalcon\Db\Adapter\Pdo;

class MysqlExtended extends Mysql {
    function __construct($descriptor)
    {

        parent::__construct($descriptor);

        $this->setDialect(new \Phalcon\Db\Dialect\MysqlExtended());

    }


    /**
     * Returns the SQL column definition from a column
     *
     * @param \Phalcon\Mvc\Model\Column $column
     * @return string
     */
    public function getColumnDefinition($column)
    {


        $definition = $mysqltype = parent::getColumnDefinition($column);


        if($column->getMysqlType() && $column->getMysqlType() !=$mysqltype){
            $definition = $column->getMysqlType();
        }

        if($column->getDefault()){
            $definition .= ' '.$column->getDefault();
        }

        return $definition;
    }

}