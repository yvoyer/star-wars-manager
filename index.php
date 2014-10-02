<?php
/**
 * This file is part of the sw_manager.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

require_once 'vendor/autoload.php';

use Star\Component\FileInfo\FileInfo;
use Star\StarWarsManager\SwmParser;
use Star\StarWarsManager\Model\CardData;

$parser = new SwmParser(new FileInfo());
$data = $parser->parse(__DIR__ . '/data/DarkTimes.swm');

/**
 * @var CardData[] $result
 */
$result = array();
foreach ($data as $card) {
    $result[] = new CardData($card);
}

?>
<html>
    <head>
        <title>Star Wars Manager</title>
        <style type="text/css" >
            body { background: white; }
            .box { float:left; width: 30%; background: gray; border: 1px; border-color: black; padding: 5px; margin: 5px; }
        </style>
    </head>
    <body>
        <?php foreach ($result as $card) : ?>
            <div class="box">
                <div class="name">
                    <span><?php echo $card->getFaction()->getName(); ?></span>
                    <span><?php echo $card->isUnique() ? '*': ''; ?></span>
                    <span><?php echo $card->getName(); ?></span>
                    <span><?php echo $card->getCost(); ?></span>
                </div>

                <div class="image"><img src="data/<?php echo $card->getImage(); ?>"/></div>

                <div class="info">
                    <ul>
                        <li><span>Attack:</span><?php echo $card->getAttack() ?></li>
                        <li><span>Defense:</span><?php echo $card->getDefense() ?></li>
                        <li><span>Base:</span><?php echo $card->getBase() ?></li>
                        <li><span>Damage:</span><?php echo $card->getDamage() ?></li>
                        <li><span>HitPoint:</span><?php echo $card->getHitPoint() ?></li>
                        <li><span>Force Point:</span><?php echo $card->getForcePoint() ?></li>
                    </ul>
                </div>

                <div class="abilities">
                    <?php echo $card->getSpecialAbilities() ?>
                </div>

                <div class="flavor">
                    <?php echo $card->getFlavorText() ?>
                </div>
            </div>
        <?php endforeach; ?>
    </body>
</html>
