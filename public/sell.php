<?php
// conf
    require("../includes/config.php"); 
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $symbols = CS50::query("SELECT symbol FROM portfolio WHERE user_id = ?", $_SESSION["id"]);
        render("sell_form.php", ["title" => "Sell", "symbols" => $symbols]);
         
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ($_POST["symbol"]=='Symbols')
        {
            apologize("Please enter the stock symbol.");
        }
        
        $stock = lookup($_POST["symbol"]);
        $shares = CS50::query("SELECT shares FROM portfolio WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        // if mas ni negativo
        $sold_shares = $_POST["sold_shares"];
        
        if ($_POST["sold_shares"] == NULL)
        {
            apologize("Enter a number of shares");
        }
        else if ($_POST["sold_shares"] < 0)
        {
            apologize("Enter a positive amount");
        }
        else if ($_POST["sold_shares"] > $shares[0]["shares"])
        {
            apologize("Not enough shares to sell");
        }
        $value = $stock["price"] * $sold_shares;
        
       
        if ($_POST["sold_shares"] < $shares[0]["shares"])
        {
            $rows = CS50::query("UPDATE portfolio SET shares = (shares - ".$sold_shares.") WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $stock["symbol"]);
        }
        else if ($_POST["sold_shares"] == $shares[0]["shares"])
        {
            $rows = CS50::query("DELETE FROM portfolio WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $stock["symbol"]);
        }
         CS50::query("UPDATE users SET cash = (cash + ".$value.") WHERE id = ?", $_SESSION["id"]);
        $type = 'Sell';
        CS50::query("INSERT INTO history (user_id, transaction, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", $_SESSION["id"], $type, $_POST["symbol"], $shares[0]["shares"], $stock["price"]);
        
        redirect("/");    
    }    
?>