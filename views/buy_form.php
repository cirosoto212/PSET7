<h1 style ="text-align: center; font-family: Gothic; font-size: 40px">Buy</h1>
<form action="buy.php" method="post">
    <fieldset>
        <div class="form-group">
            <input value="<?= $symbol ?>" name="symbol" placeholder="Symbol" type="text"/>
        </div>
        <div class="form-group">
            <input name="shares" placeholder="Shares" type="text"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn">Buy</button>
        </div>
        <a href="/"><img alt="Wolf" src="/img/wolfof.jpg"/></a>
    </fieldset>
</form>