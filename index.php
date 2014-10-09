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
    if (false === isset($card['TotalInSet'])) {
        $result[] = new CardData($card);
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Star Wars Manager</title>
        <link rel="stylesheet" type="text/css" href="styles.css" media="all">
    </head>
    <body>
        <?php $i = 0; ?>
        <?php foreach ($result as $card) : ?>
            <div class="card">
                <div class="inner <?php echo strtolower(str_replace(array(' '), '-', $card->getFaction()->getName())); ?>">
                    <div class="name">
                        <span>
                            <?php echo $card->isUnique() ? '*': ''; ?>
                            <?php echo $card->getName(); ?>
                        </span>
                        <span class="cost"><?php echo $card->getCost(); ?></span>
                    </div>

                    <div class="image"><img src="data/<?php echo $card->getImage(); ?>"/></div>

                    <div class="info">
                        <ul>
                            <li><span>Attack:</span><?php echo $card->getAttack() ?></li>
                            <li><span>Defense:</span><?php echo $card->getDefense() ?></li>
                            <li><span>Base:</span><?php echo $card->getBase() ?></li>
                        </ul>
                        <ul>
                            <li><span>Damage:</span><?php echo $card->getDamage() ?></li>
                            <li><span>HitPoint:</span><?php echo $card->getHitPoint() ?></li>
                            <li><span>Force Point:</span><?php echo $card->getForcePoint() ?></li>
                        </ul>
                        <div class="clear"></div>
                    </div>

                    <div class="abilities">
                        <?php echo $card->getSpecialAbilities() ?>
                    </div>

                    <div class="flavor">
                        <?php echo $card->getFlavorText() ?>
                    </div>
                </div>
            </div>
            <?php if ($i ++ % 2 == 0): ?><div class="clear"></div><?php endif; ?>
        <?php endforeach; ?>
    </body>
</html>
