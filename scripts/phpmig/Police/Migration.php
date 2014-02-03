<?php
namespace MyPhpmig\Police;

class Migration extends \Phpmig\Migration\Migration
{
    protected $_zones;
    protected $_queries;

    public function up()
    {
        if(empty($this->_queries)) {
            throw new Exception('Query is empty!');
        }

        $this->_executePerZone();

        return;
    }

    public function down()
    {
        if(empty($this->_queries)) {
            throw new Exception('Query is empty!');
        }

        $this->_executePerZone();

        return;
    }

    public function getZones()
    {
        if(!$this->_zones)
        {
            $container = $this->getContainer();

            $this->_zones = new Zones(array('adapter' => $container['db']));
        }

        return $this->_zones;
    }

    protected function _executePerZone()
    {
        if(empty($this->_queries)) {
            throw new Exception('Empty query');
        }

        $container  = $this->getContainer();
        $adapter    = $container['db'];

        $zones      = $this->getZones()->get();

        // Get the current database
        $row      = $adapter->query('SELECT database();', \PDO::FETCH_COLUMN, 0);
        $database = $row->fetch();

        // Execute the queries on the selected databases
        foreach($zones as $zone => $title)
        {
            $db = $zone;

            if(!$this->_databaseExists($db)) {
                continue;
            }

            $sql = 'USE `' . $db .'`;';
            $sql .= $this->_queries;

            $this->getOutput()->writeln('      => applying to zone <fg=cyan>'.$zone.'</fg=cyan> ('.$title.') ..');

            $adapter->exec($sql);
        }

        // Move back to the original database
        $adapter->exec('USE `' . $database . '`');
    }

    protected function _databaseExists($database)
    {
        $container = $this->getContainer();
        $adapter   = $container['db'];

        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = " . $adapter->quote($database);

        $result = $adapter->query($query);

        if(!$result) {
            return false;
        }

        return $result->rowCount();
    }
}