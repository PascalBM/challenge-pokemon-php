<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Pokédex</title>
</head>
<body>
<?php
const PokeURL = "https://pokeapi.co/api/v2/pokemon/"; // const poke url
$pokemonId ="25"; // start pokemon
if (isset($_GET["searchValue"])){
    $pokemonId = $_GET["searchValue"];
    if($pokemonId==""){
        $pokemonId = 25; // if the is empty it start in 25
    }
}


// Read JSON file
$json_data = file_get_contents(PokeURL . $pokemonId); // poke url declared before
// Decode JSON data into PHP array
$response_data = json_decode($json_data);
// All pokemon data exists in 'data' object
$img = $response_data->sprites->front_default;
$id = $response_data->id;
$name = $response_data->name;
$moves = $response_data->moves;
$moves = array_slice($moves, 0, 4);


$api_url2 = "https://pokeapi.co/api/v2/pokemon-species/".$pokemonId;

// Read JSON file
$json_data = file_get_contents($api_url2);
// Decode JSON data into PHP array
$response_data = json_decode($json_data,JSON_OBJECT_AS_ARRAY);
//var_dump((array_values($response_data)[4]['url'])); //save into variable


$api_url3 = array_values($response_data)[4]['url'];

$json_data = file_get_contents($api_url3);
// Decode JSON data into PHP array
$response_data = json_decode($json_data,JSON_OBJECT_AS_ARRAY);
//var_dump(array_values($response_data));
//acces the name inside the array
$name2 = [array_values($response_data)[1]['species']['name']]; // [1]outside because array_values is with reponse_data

//created an if statement
if(count(array_values($response_data)[1]["evolves_to"]) < 1 == false) {
    array_push($name2, array_values($response_data)[1]["evolves_to"][0]["species"]["name"]);
    if (count(array_values($response_data)[1]["evolves_to"][0]["evolves_to"]) < 1 == false) {
        array_push($name2, array_values($response_data)[1]["evolves_to"][0]["evolves_to"][0]["species"]["name"]);
    }
}

/*foreach ($name2 as $value) {
    echo $value;
    $json_data = file_get_contents(PokeURL . $value); // poke url declared before
// Decode JSON data into PHP array
    $response_data = json_decode($json_data, JSON_OBJECT_AS_ARRAY);
    $imgevo = array_values($response_data)[14]["front_default"];

    if  (isset($imgevo)) {
        echo "<img src='$imgevo'> </img>" ;
} else {
        //echo "<img src='array_values($response_data)[14]['front_default']'> </img>" ;
}
}
*/

//if(array_values($response_data)["evolves_to"][1] < 1 == false)
?>
<header>
    <h1><img src="/images/Pokédex_logo.png" class="pokedex" alt="pokedex"></h1><img src="https://i.ya-webdesign.com/images/pokeball-pixel-png-2.png" alt="pokeball"/>
</header>
<section></section>
<form>
<div>
    <input id="input" placeholder="Pokémon name or ID" method="GET" name="searchValue">
    <button class="btn" id="searchBtn">search</button>
</div>
</form>
<img src=" <?php echo $img ?> " class="pokemon" id="image" alt="pokemon">
<div class="pokemon" id="pokeId"><?php echo "ID-Number: ".$id ?></div>
<div class="pokemon" id="name"><?php echo "Name: ". $name ?></div>
<div class="pokemon" id="pokemoves">
    <?php
    $moves_length = count($moves);
    if($moves_length <= 4) {
        for ($x = 0; $x < count($moves); $x++) {
            echo "<li >{$moves[$x]->move->name}</li>";
        }
    } else {
        for ($x = 0; $x < 4; $x++) {
            echo "<li >{$moves[$x]->move->name}</li>";
        }
    }

    ?>
</div>
<?php foreach ($name2 as $value) {
//echo $value;
$json_data = file_get_contents(PokeURL . $value); // poke url declared before
// Decode JSON data into PHP array
$response_data = json_decode($json_data, JSON_OBJECT_AS_ARRAY);
$imgevo = array_values($response_data)[14]["front_default"];

if  (isset($imgevo)) {
echo "<img src='$imgevo'> </img>" ;
} else {
//echo "<img src='array_values($response_data)[14]['front_default']'> </img>" ;
}
}
?>
<div>
    <button class="btn" id="previousBtn">previous</button>
    <button class="btn" id="nextBtn">next</button>
</div>

</body>
</html>
