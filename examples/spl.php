<?php

require_once __DIR__.'/../vendor/autoload.php';
Ladybug\Loader::loadHelpers();

$numbers = array(10, 15, 1, 56, 3);

// Heaps
$maxHeap = new \SplMaxHeap();
foreach ($numbers as $item) {
    $maxHeap->insert($item);
}

$minHeap = new \SplMinHeap();
foreach ($numbers as $item) {
    $minHeap->insert($item);
}

// Stacks
$stack = new \SplStack();
foreach ($numbers as $item) {
    $stack->push($item);
}

// Queues
$queue = new \SplQueue();
foreach ($numbers as $item) {
    $queue->push($item);
}

$dumper = new \Ladybug\Dumper();
echo $dumper->dump($maxHeap, $minHeap, $stack, $queue);