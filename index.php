<?php
/**
 * This file is part of the sw_manager.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

require_once 'vendor/autoload.php';

use Star\Component\FileInfo\FileInfo;
use Star\StarWarsManager\SwmParser;

$parser = new SwmParser(new FileInfo());
var_dump($parser->parse(__DIR__ . '/data/DarkTimes.swm'));
