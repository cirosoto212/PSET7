<?php

    // configuration
    require("../includes/config.php"); 

    $rows = CS50::query("SELECT * FROM portfolio WHERE user_id = ?", $_SESSION["id"]);	
    $cash = cs50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
    $lastname = cs50::query("SELECT lastname FROM users WHERE id = ?", $_SESSION["id"]);
    $firstname = cs50::query("SELECT firstname FROM users WHERE id = ?", $_SESSION["id"]);
    $cash = $cash[0]["cash"];
    $firstname = $firstname[0]["firstname"];
    $lastname = $lastname[0]["lastname"];
    //Body
    $positions = [];
    foreach ($rows as $row)
    {
    $stock = lookup($row["symbol"]);
    if ($stock !== false)
    {
        $positions[] = [
            "name" => $stock["name"],
            "price" => $stock["price"],
            "shares" => $row["shares"],
            "symbol" => $row["symbol"],
            "total" => $row["shares"]*$stock["price"]
        ];
        }
    }
    // render portfolio
    render("portfolio.php", ["cash" => $cash, "lastname" => $lastname, "firstname" => $firstname, "positions" => $positions, "title" => "Portfolio"]);
    
?>
