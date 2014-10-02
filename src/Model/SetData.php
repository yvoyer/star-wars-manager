<?php
/**
 * This file is part of the sw_manager.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\StarWarsManager\Model;

/**
 * Class SetData
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\StarWarsManager\Model
 */
class SetData
{
    const ID = 'Set';
    const NAME = 'SetDisplay';

    /**
     * @var string
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
     * @return string
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
 