<h1><?= $stock["name"]?></h1>
Price: $<?= $stock["price"]?>
<div class = "form-group">
    <a class = "btn btn-default" href = "buy.php?symbol=<?=$stock["symbol"]?>">
        Purchase stocks
    </a>
</div>