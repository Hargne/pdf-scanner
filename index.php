<?php
    require('getPDFContent.class.php');

    // Replace the filename with an existing PDF
    $pdfPath = 'ticket.pdf';

    $getPDFContent = new getPDFContent($pdfPath);
    $tickets = $getPDFContent->getTickets();

    if(!$tickets) {
	    echo "The PDF did not contain any information";
    } else {
        foreach ($tickets as $i=>$ticket) {
            // Print it out in an old fashioned way :)
            echo "<div style='margin-bottom: 1em;'>";
                echo "<div style='font-weight:bold;'>Ticket no " . ($i + 1) . "</div>";
                echo "<div>Plats: " . $ticket["seat"] . "</div>";
                echo "<div>Rad: " . $ticket["row"]. "</div>";
                echo "<div>Datum: " . $ticket["date"] . "</div>";
                echo "<div>Tid: " . $ticket["time"] . "</div>";
            echo "</div>";
        }
    }
?>