<?php
use Nooku\Library;

class SupportDatabaseRowsetZones extends Library\DatabaseRowsetAbstract
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'identity_column'   => 'id'
        ));

        parent::_initialize($config);
    }


    public function addRow(array $rows, $status = NULL)
    {
        if ($this->_row_cloning)
        {
            $default = $this->getRow()->setStatus($status);

            foreach ($rows as $k => $data)
            {
                $row = clone $default;
                $row->setData($data, $row->isNew());

                $this->insert($row);
            }
        }
        else
        {
            foreach ($rows as $k => $data)
            {
                $row = $this->getRow()->setStatus($status);
                $row->setData($data, $row->isNew());

                $this->insert($row);
            }
        }

        return $this;
    }
}