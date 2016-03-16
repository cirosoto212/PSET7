<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("add_form.php", ["title" => "Add money"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (preg_match("/^\d+$/", $_POST["add"] == NULL))
        {
            apologize("You must enter a valid data");
        }
        else if ($_POST["add"] == NULL)
        {
            apologize("You must enter a amount of money");
        }
        else
        {
            CS50::query("UPDATE  users SET cash = (cash + ?) WHERE id = ?", $_POST["add"], $_SESSION["id"]);
        }
        redirect("/");
    }

?>