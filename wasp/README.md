# The Wasps Game


A simple web-based game built with raw PHP, HTML, and CSS — no frameworks, no libraries. Hit random wasps, watch them lose health, and try to survive the queen's wrath!

---

## Gameplay Overview

You are presented with a **nest of wasps**:

- **1 Queen** – 80 HP, loses 7 HP per hit. If she dies, **all wasps die.**
- **5 Worker Wasps** – 68 HP each, lose 10 HP per hit.
- **8 Drone Wasps** – 60 HP each, lose 12 HP per hit.

### Goal

- Press the **"Hit Wasp"** button to randomly hit one alive wasp.
- Game ends when **all wasps are dead**.
- Restart the game anytime after it ends.

---

##  Requirements
- PHP 8.2

## Installation
- Clone this repository into your web root
```bash
- git clone https://git@github.com:Hillaryudechukwu/wasp.git
   cd wasp
   ```
- Run:
```bash
 php -S localhost:8000
 ```
- You can localhost:8000 or localhost:8000/noCssWasp.php to play
##  Run Test
```bash
php waspsTest.php
