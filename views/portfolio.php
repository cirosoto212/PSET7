
<h4 style= "text-align: right; font-family: Arial black;"> <strong>Hello, <?= $firstname ?>  <?= $lastname ?></strong></h4>
<iframe width="560" height="315" src="https://www.youtube.com/embed/F3QpgXBtDeo?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
<h1 style= "font-size: 60px; color: blue; font-family: Courier;"> CURRENT CASH: $<?= number_format($cash) ?></h1>

<table class = "table table-stripped">
    <thead>
        <tr>
            <th style = "color: red;">Name</th>
            <th style = "color: red;">Symbol</th>
            <th style = "color: red;">Shares</th>
            <th style = "color: red;">Price</th>
            <th style = "color: red;">Total</th>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach ($positions as $position): ?>

    <tr>
        <td style = "font-family: Arial black;"><?= $position["name"] ?></td>
        <td style = "font-family: Verdana; font-size: 15px;"><i><?= $position["symbol"] ?></i></td>
        <td><?= $position["shares"] ?></td>
        <td style = "font-size: 15px;"><strong><?= number_format($position["price"],2) ?></strong></td>
        <td style = "font-size: 15px;"><strong><?= number_format($position["total"],2) ?></strong></td>
    </tr>

<?php endforeach ?>
    </tbody>
</table>