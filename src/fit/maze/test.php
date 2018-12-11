<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2018/12/10 17:14
 */

require 'Node.php';
require 'NodeBuilder.php';
require 'Visitor.php';
require 'Maze.php';
require 'TestMaze.php';

$testMaze = new \fit\maze\TestMaze();
echo $testMaze->run();
var_dump($testMaze->step);