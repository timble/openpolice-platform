<?php
namespace MyPhpmig\Police;

class Zones
{
    private   $__columns = array('police_zone_id', 'title', 'language', 'phone_emergency', 'phone_information',
                                'email', 'chief_name', 'chief_email', 'twitter', 'facebook');

    protected $_adapter;
    protected $_wheres = array();
    protected $_list;

    public function __construct(array $options = array())
    {
        $this->_adapter = $options['adapter'];
    }

    /**
     * Fetch an array of the requested zones.
     *
     * @return array List of selected zones
     */
    public function get()
    {
        if(!$this->_list)
        {
            $query = 'SELECT `police_zone_id`, `title` FROM `data`.`police_zones`';

            if(is_array($this->_wheres) && count($this->_wheres))
            {
                $query .= ' WHERE';

                foreach($this->_wheres as $where)
                {
                    if(isset($where['condition'])) {
                        $query .= ' '.$where['condition'];
                    }

                    $query .= ' `'.$where['column'].'` ';

                    if(isset($where['constraint']))
                    {
                        $value = $this->_adapter->quote($where['value']);

                        if(in_array($where['constraint'], array('IN', 'NOT IN'))) {
                            $value = ' ( '.$value.' ) ';
                        }

                        $query .= ' '.$where['constraint'].' '.$value;
                    }
                }
            }

            $rows = $this->_adapter->query($query);

            $zones = array();
            while($row = $rows->fetch(\PDO::FETCH_ASSOC)) {
                $zones[$row['police_zone_id']] = $row['title'];
            }

            $this->_list = $zones;
        }

        return $this->_list;
    }

    /**
     * Set an array of zones. The array should look as follows:
     *  array('zone number' => 'zone name');
     *
     * @param array $zones
     */
    public function set(array $zones)
    {
        $this->_list = $zones;
    }

    /**
     * Manually add a zone to the list.
     *
     * @param $zone
     * @return $this
     */
    public function append($zone, $title = '')
    {
        if(empty($zone)) {
            return;
        }

        $this->get();

        $this->_list[$zone] = $title;

        return $this;
    }

    /**
     * Reset the constraints currently set
     */
    public function reset()
    {
        $this->_wheres = array();
        $this->_list   = null;

        return $this;
    }

    /**
     * Builds the where clause of the query used to fetch the zone numbers.
     *
     * @param   string          The name of the property the constraint applies too, or a SQL function or statement
     * @param   string          The comparison used for the constraint
     * @param   string|array    The value compared to the property value using the constraint
     * @param   string          The where condition, defaults to 'AND'
     *
     * @return  $this
     */
    public function where($column, $constraint, $value, $condition = 'AND')
    {
        if(empty($column) || !in_array($column, $this->__columns)) {
            throw new Exception($column . ' is not a valid zone filter');
        }

        $where = array();
        $where['column'] = $column;

        if(isset($constraint))
        {
            $constraint = strtoupper($constraint);
            $condition  = strtoupper($condition);

            $where['constraint'] = $constraint;
            $where['value']      = $value;
        }

        $where['condition']  = count($this->_wheres) ? $condition : '';

        if(is_array($value)) {
            $signature = md5($column.$constraint.serialize($value));
        } else {
            $signature = md5($column.$constraint.$value);
        }

        if(!isset($this->_wheres[$signature])) {
            $this->_wheres[$signature] = $where;
        }

        return $this;
    }
}