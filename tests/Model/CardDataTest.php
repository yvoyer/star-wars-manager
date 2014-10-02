<?php
/**
 * This file is part of the sw_manager.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\StarWarsManager\Model;

/**
 * Class CardDataTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\StarWarsManager\Model
 */
class CardDataTest extends \PHPUnit_Framework_TestCase
{
    public function test_should_set_name()
    {
        $card = CardData::createFromArray(
            array(
                CardData::ID => 'id',
                CardData::NAME => 'name',
                CardData::IS_UNIQUE => '1',
                CardData::IMAGE_FOLDER => 'image-folder',

                CardData::NUMBER => 'number',
                CardData::DAMAGE => 'damage',
                CardData::COST => 'cost',
                CardData::ATTACK => 'attack',
                CardData::DEFENSE => 'defense',
                CardData::HIT_POINT => 'hp',
                CardData::FORCE_POINTS => 'fp',

                CardData::FLAVOR_TEXT => 'flavor-text',
                CardData::SPECIAL_ABILITIES => 'sa',
                CardData::TYPE => 'type',
                CardData::BASE => 'base',
            )
        );

        $this->assertInstanceOf('Star\StarWarsManager\Model\CardData', $card);
        $this->assertSame('id', $card->getId());
        $this->assertSame('name', $card->getName());
        $this->assertTrue($card->isUnique());
        $this->assertSame('image-folder', $card->getImage());
        $this->assertSame('number', $card->getNumber());
        $this->assertSame('damage', $card->getDamage());
        $this->assertSame('cost', $card->getCost());
        $this->assertSame('attack', $card->getAttack());
        $this->assertSame('defense', $card->getDefense());
        $this->assertSame('hp', $card->getHitPoint());
        $this->assertSame('fp', $card->getForcePoint());

        $this->assertSame('flavor-text', $card->getFlavorText());
        $this->assertSame('sa', $card->getSpecialAbilities());
        $this->assertSame('type', $card->getType());
        $this->assertSame('base', $card->getBase());
    }

    public function test_should_set_the_set()
    {
        $data = CardData::createFromArray(
            array(
                SetData::ID => 'set-id',
                SetData::NAME => 'set-name',
            )
        );
        $set = $data->getSet();

        $this->assertInstanceOf('Star\StarWarsManager\Model\SetData', $set);
        $this->assertSame('set-id', $set->getId());
        $this->assertSame('set-name', $set->getName());
    }

    public function test_should_set_the_faction()
    {
        $data = CardData::createFromArray(
            array(
                FactionData::ID => '123',
                FactionData::NAME => 'faction-name',
            )
        );
        $faction = $data->getFaction();

        $this->assertInstanceOf('Star\StarWarsManager\Model\FactionData', $faction);
        $this->assertSame('123', $faction->getId());
        $this->assertSame('faction-name', $faction->getName());
    }

    public function test_image_should_use_platform_dir_separator()
    {
        $card = new CardData(array(CardData::IMAGE_FOLDER => 'qwe/2.jpg'));
        $this->assertSame('qwe' . DIRECTORY_SEPARATOR . '2.jpg', $card->getImage());
        $card = new CardData(array(CardData::IMAGE_FOLDER => 'qwe\2.jpg'));
        $this->assertSame('qwe' . DIRECTORY_SEPARATOR . '2.jpg', $card->getImage());
    }
}
 