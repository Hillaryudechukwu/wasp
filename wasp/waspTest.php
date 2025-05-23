<?php
require_once 'wasp.php';

function assertEquals($a, $b, $message)
{
    if ($a !== $b) {
        echo "Test failed: $message. Expected $a, got $b\n";
    } else {
        echo "Test passed: $message\n";
    }
}
function runTest()
{
    $game = new WaspGame();
    $game->initialize();

    echo "Runing Wasp Game Test.....\n";

    // Test 1: Initial Wasp Counts
    $count = [
        'Queen' => 0,
        'Worker' => 0,
        'Drone' => 0,
    ];

    foreach ($game->wasps as $wasp) {

        if (isset($count[$wasp->type])) {
            $count[$wasp->type]++;
        }
    }

    assertEquals($count['Queen'], 1, "There should be only 1 Queen");
    assertEquals($count['Worker'], 5, "We should have 5 Workers");
    assertEquals($count['Drone'], 8, "We should have 8 Drones");

    // Test 2: Queen gets hit correctly
    $queen = $game->wasps[0];
    $initialHP = $queen->hitPoints;
    $queen->hit();
    assertEquals($queen->hitPoints, $initialHP - 7, "Queen should lose 7 HP when hit");

    // Test 3: Queen death causes all wasps to die
    $queen->hitPoints = 7;
    $game->hitRandomWasp();
    if ($game->wasps[0]->isDead()) {
        $allDead = true;
        foreach ($game->wasps as $wasp) {
            if (!$wasp->isDead()) $allDead = false;
        }
        assertEquals($allDead, true, "All wasps should die if Queen dies");
    } else {
        echo "[SKIP] Queen was not hit. Cannot test Queen death logic in this run.\n";
    }

}
runTest();