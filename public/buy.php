<?php
    
    // configuration 
    require("../includes/config.php");   
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
    // render
     render("buy_form.php", ["title" => "Buy"]);
    }
    // if form is submitted
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
       if (empty($_POST["symbol"]) || empty($_POST["shares"]))
        {
            apologize("No symbol or shares were submitted");
        }
        
        if (lookup($_POST["symbol"]) === false)
        {
            apologize("Invalid");
        }
        
        if (preg_match("/^\d+$/", $_POST["shares"]) == false)
        {
            
            apologize("Invalid");
        }
        
        $stock = lookup($_POST["symbol"]);
        
       $cost = $stock["price"] * $_POST["shares"];
        
        $cash_rows = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
        $cash = $cash_rows[0]["cash"];
        $type='Buy';

       if ($cash < $cost)
        {
            apologize("You can't afford this purchase.");
        }         
        
        else
        {
            CS50::query("INSERT INTO portfolio (user_id, symbol, shares) VALUES(?, ?, ?) 
                ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $_POST["symbol"], $_POST["shares"]);
            CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?", $cost, $_SESSION["id"]);
            CS50::query("INSERT INTO history (user_id, transaction, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", $_SESSION["id"], $type, $_POST["symbol"], $_POST["shares"], $stock["price"]);

            redirect("/");    
        }
    }
    
   
?>