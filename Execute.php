<?php
require_once('functions.php');
session_start();

require_once('Core.php');
require_once('Characters.php');
require_once('Items.php');
require_once('Weapons.php');
require_once('Inventory.php');
require_once('World.php');


// Load existing character or create a new one if it's a new game
if (isset($_SESSION['character'])) {
    $Character = unserialize($_SESSION['character']);
} else {
    $Character = new King("Solomon");
    
    $_SESSION['character'] = serialize($Character);
}


// Load existing world or create a new one if it's a new game
if (isset($_SESSION['world_state'])) {
    $World = unserialize($_SESSION['world_state']);
} else {
    $World = new World();
    
    $_SESSION['world_state'] = serialize($World);
}
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/EntityClasses.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="js/moveCharacter.js"></script>
</head>

<body>

    <div id="character"><img id="character_img" src="images/<?=get_class($Character);?>.png" /></div>
    
    <?php
    foreach ($World->Items as $id => $itemAttributes) {
        ?><img class="<?=$itemAttributes['class'];?>" id="<?=$id;?>" data-world="<?=$World->global_id;?>" src="images/<?=$itemAttributes['entity'];?>.png" style="top:<?=$itemAttributes['coordinates'][1];?>; left:<?=$itemAttributes['coordinates'][0];?>;" title="<?=$itemAttributes['desc'];?>" /><?
    }
    ?>

    <div id="panel">
        <a href="views/Console.php">Open Inventory</a> | <a href="actions/resetGame.php">Reset Game</a> | Level: <?=$World->level;?> | Health: <span id="consoleCurrentHealth"><?=$Character->currentHealth;?></span> / <?=$Character->maxHealth;?> | Armor: <span id="consoleCurrentArmor"><?=$Character->currentArmor;?></span> / <?=$Character->maxArmor;?> | Score: <?=$Character->score;?> | Gold: <span id="consoleGold"><?=$Character->gold;?></span>
    </div>
    
    <div id="messages"></div>
    
</body>
</html>