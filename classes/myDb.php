<?php
//create myDb class extend mysqli
class myDb extends mysqli
{
    public function __construct($host, $username, $passwd, $dbname)
    {
        //call parent constructor
        parent:: __construct($host, $username, $passwd, $dbname);
    }
}
