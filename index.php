<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Pokédex</title>
</head>
<body>
<?php
$api_url = 'https://pokeapi.co/api/v2/pokemon/1';

// Read JSON file
$json_data = file_get_contents($api_url);
// Decode JSON data into PHP array
$response_data = json_decode($json_data);
// All pokemon data exists in 'data' object
$img = $response_data->sprites->front_default;
$id = $response_data->id;
$name = $response_data->name;
$moves = $response_data->moves;
$moves = array_slice($moves, 0, 4);
?>
<header>
    <h1><img src="/images/Pokédex_logo.png" class="pokedex" alt="pokedex"></h1><img src="https://i.ya-webdesign.com/images/pokeball-pixel-png-2.png" alt="pokeball"/>
</header>
<section></section>
<div>
    <input id="input" placeholder="Pokémon name or ID">
    <button class="btn" id="searchBtn">search</button>
</div>
<img src=" <?php echo $img ?> " class="pokemon" id="image" alt="pokemon">
<div class="pokemon" id="pokeId"><?php echo $id ?></div>
<div class="pokemon" id="name"><?php echo $name ?></div>
<div class="pokemon" id="pokemoves">
    <?php
    for ($x = 1; $x <= 4; $x++) {
        echo "<p key=$x>{$moves[$x]->move->name}</p>";
    }
    ?>
</div>
<img src="" class="pokemon" id="evo-1" alt="evo1">
<img src="" class="pokemon" id="evo-2" alt="evo2">
<img src="" class="pokemon" id="evo-3" alt="evo3">
<div>
    <button class="btn" id="previousBtn">previous</button>
    <button class="btn" id="nextBtn">next</button>
</div>

</body>
</html>
