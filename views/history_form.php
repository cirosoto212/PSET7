<table class="table table-striped">

    <thead>
        <tr>
            <th style ="color: purple;">Type</th>
            <th style ="color: purple;">Date and Time</th>
            <th style ="color: purple;">Symbol</th>
            <th style ="color: purple;">Shares</th>
            <th style ="color: purple;">Price</th>
        </tr> 
    </thead>


    <tbody>
    <?php
	    foreach ($table as $row)	
        {   
            echo("<tr>");
            echo("<td>" . $row["transaction"] . "</td>");
            echo("<td>" . date('d/m/y, g:i A',strtotime($row["datetime"])) . "</td>");
            echo("<td>" . $row["symbol"] . "</td>");
            echo("<td>" . $row["shares"] . "</td>");
            echo("<td>$" . number_format($row["price"], 2) . "</td>");
            echo("</tr>");
        }
    ?>
    </tbody>
</table>