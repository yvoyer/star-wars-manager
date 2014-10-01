<?php
/**
 * This file is part of the sw_manager.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\StarWarsManager\Model;

/**
 * Class CardData
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\StarWarsManager\Model
 */
class CardData
{
    const ID = 'MiniID';
    const NAME = 'Name';
    const IS_UNIQUE = 'UniqueIdentifier';
    const IMAGE_FOLDER = 'CharacterJPGImage';

    const NUMBER = 'Number';
    const DAMAGE = 'Damage';
    const COST = 'PlayCost';
    const ATTACK = 'Attack';
    const DEFENSE = 'Defense';
    const HIT_POINT = 'HitPoints';
    const FORCE_POINTS = 'ForcePoints';

    const FLAVOR_TEXT = 'FlavorText';
    const SPECIAL_ABILITIES = 'SpecialAbilities';
    const TYPE = 'Type';
    const BASE = 'Base';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $isUnique;

    /**
     * @var SetData
     */
    private $set;

    /**
     * @var FactionData
     */
    private $faction;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $damage;

    /**
     * @var string
     */
    private $cost;

    /**
     * @var string
     */
    private $attack;

    /**
     * @var string
     */
    private $hitPoint;

    /**
     * @var string
     */
    private $defense;

    /**
     * @var string
     */
    private $forcePoint;

    /**
     * @var string
     */
    private $specialAbilities;

    /**
     * @var string
     */
    private $flavorText;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $base;

    /**
     * @var string
     */
    private $squad;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $abilitiesMask1;

    /**
     * @var string
     */
    private $abilitiesMask2;

    /**
     * @var string
     */
    private $ceEligibility;

    /**
     * @var string
     */
    private $ceLeadership;

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

        if (isset($data[self::IS_UNIQUE])) {
            $this->isUnique = (bool) $data[self::IS_UNIQUE];
        }

        if (isset($data[self::IMAGE_FOLDER])) {
            $this->image = $data[self::IMAGE_FOLDER];
        }

        if (isset($data[self::NUMBER])) {
            $this->number = $data[self::NUMBER];
        }

        if (isset($data[self::DAMAGE])) {
            $this->damage = $data[self::DAMAGE];
        }

        if (isset($data[self::COST])) {
            $this->cost = $data[self::COST];
        }

        if (isset($data[self::ATTACK])) {
            $this->attack = $data[self::ATTACK];
        }

        if (isset($data[self::DEFENSE])) {
            $this->defense = $data[self::DEFENSE];
        }

        if (isset($data[self::HIT_POINT])) {
            $this->hitPoint = $data[self::HIT_POINT];
        }

        if (isset($data[self::FORCE_POINTS])) {
            $this->forcePoint = $data[self::FORCE_POINTS];
        }

        if (isset($data[self::FLAVOR_TEXT])) {
            $this->flavorText = $data[self::FLAVOR_TEXT];
        }

        if (isset($data[self::SPECIAL_ABILITIES])) {
            $this->specialAbilities = $data[self::SPECIAL_ABILITIES];
        }

        if (isset($data[self::TYPE])) {
            $this->type = $data[self::TYPE];
        }

        if (isset($data[self::BASE])) {
            $this->base = $data[self::BASE];
        }

        $this->set = new SetData($data);
        $this->faction = new FactionData($data);
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

    /**
     * Returns whether the card is unique.
     *
     * @return boolean
     */
    public function isUnique()
    {
        return $this->isUnique;
    }

    /**
     * Returns the Image.
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Returns the cost.
     *
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Returns the Set.
     *
     * @return SetData
     */
    public function getSet()
    {
        return $this->set;
    }

    /**
     * Returns the Faction.
     *
     * @return FactionData
     */
    public function getFaction()
    {
        return $this->faction;
    }

    /**
     * Returns the Defense.
     *
     * @return string
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * Returns the Damage.
     *
     * @return string
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * Returns the Attack.
     *
     * @return string
     */
    public function getAttack()
    {
        return $this->attack;
    }

    /**
     * Returns the Number.
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Returns the HitPoint.
     *
     * @return string
     */
    public function getHitPoint()
    {
        return $this->hitPoint;
    }

    /**
     * Returns the ForcePoint.
     *
     * @return string
     */
    public function getForcePoint()
    {
        return $this->forcePoint;
    }

    /**
     * Returns the SpecialAbilities.
     *
     * @return string
     */
    public function getSpecialAbilities()
    {
        return $this->specialAbilities;
    }

    /**
     * Returns the Type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns the FlavorText.
     *
     * @return string
     */
    public function getFlavorText()
    {
        return $this->flavorText;
    }

    /**
     * Returns the Base.
     *
     * @return string
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * @param array $data
     *
     * @return CardData
     */
    public static function createFromArray(array $data)
    {
        $card = new self($data);

        return $card;
    }
}
 