<?php
/**
 * This file is part of the sw_manager.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\StarWarsManager\Model;

/**
 * Class FactionData
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\StarWarsManager\Model
 */
class FactionData
{
    const ID = 'FactionID';
    const NAME = 'Faction';

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @param array $data
     */
    public function __construct(array $data = array())
    {
        if (isset($data[self::ID])) {
            $this->id = $data[self::ID];
        }

        if (isset($data[self::NAME])) {
            $this->name = $data[self::NAME];
        }
    }

    /**
     * Returns the Id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the Name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
 