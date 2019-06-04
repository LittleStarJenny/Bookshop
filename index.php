<?php
include_once 'header.php';

?>

<main>
    <p>Välkommen till Bookshop! </p>
    <p>Här kan du ladda upp en csv-fil med ISBN-nummer och få tillbaka en lista med Titel, Författare och Förlag<p>
    <p>OBS! Tänk på att filen inte får innehålla några rubriker!</p>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <button type="submit" name="submit" class="upload">UPLOAD</button>
        </form>
</main>


    </body>
</html>