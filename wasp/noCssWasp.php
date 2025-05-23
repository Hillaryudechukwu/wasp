<?php
session_start();
require_once 'wasp.php';

if (!isset($_SESSION['game'])) {
    $game = new WaspGame();
    $game->initialize();
    $_SESSION['game'] = serialize($game);
} else {
    $game = unserialize($_SESSION['game']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['hit']) && !$game->isGameOver()) {
        $game->hitRandomWasp();
    } elseif (isset($_POST['reset'])) {
        session_destroy();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    $_SESSION['game'] = serialize($game);
}
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wasp Game </title>
</head>
<body>
    <h1>Wasp Game With No CSS</h1>
    <form method="post">
        <?php if (!$game->isGameOver()): ?>
            <button type="submit" name="hit">Hit a Randomly</button>
        <?php else: ?>
            <p>Game Over!</p>
            <button type="submit" name="reset">Start New Game</button>
        <?php endif; ?>
    </form>

    <h2>Status:</h2>
    <?php foreach ($game->wasps as $i => $wasp): ?>
        <div class="wasp <?= $wasp->type ?> <?= $wasp->isDead() ? 'dead' : '' ?>
            <?= $i === $game->lastHitIndex ? 'hit' : '' ?>">
            <?= $wasp->type ?> Wasp <?= $i+1 ?>:
            <?= $wasp->isDead() ? 'Dead' : $wasp->health . ' HP' ?>
        </div>
    <?php endforeach; ?>
</body>
</html>
