<?php
class Wasp {
    public $type;
    public $health;
    public $attackStrength;

    public function __construct($type, $health, $attackStrength)
    {
        $this->type = $type;
        $this->health = $health;
        $this->attackStrength = $attackStrength;
    }
    public function isDead()
    {
        return $this->health <= 0;
    }

    public function hit()
    {
        if (!$this->isDead()) {
            $this->health -= $this->attackStrength;
            if ($this->health < 0) $this->health = 0;
        }
    }
}

class WaspGame {
    public $wasps = [];
    public $lastHitIndex = null;

    public function initialize()
    {
        $this->wasps = [];

        $this->wasps[] = new Wasp("Queen", 80, 7);
        for ($i = 0; $i < 5; $i++) $this->wasps[] = new Wasp("Worker", 68, 10);
        for ($i = 0; $i < 8; $i++) $this->wasps[] = new Wasp("Drone", 60, 12);
    }

    public function isGameOver()
    {
        foreach ($this->wasps as $wasp) {
            if (!$wasp->isDead()) return false;
        }
        return true;
    }

    public function hitRandomWasp()
    {
        $alive = [];
        foreach ($this->wasps as $index => $wasp) {
            if (!$wasp->isDead()) $alive[] = $index;
        }

        if (empty($alive)) return;

        $chosen = $alive[array_rand($alive)];
        $this->wasps[$chosen]->hit();
        $this->lastHitIndex = $chosen;

        if ($this->wasps[$chosen]->type === "Queen" && $this->wasps[$chosen]->isDead()) {
            foreach ($this->wasps as $wasp) {
                $wasp->health = 0;
            }
        }
    }
}
