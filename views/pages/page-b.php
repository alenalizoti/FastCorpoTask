<?php
$title = 'Page B';
require_once __DIR__ . '/../layout/header.php';
?>

    <main>
        <h1>Page B</h1>
        <p>Click the button below to download the file.</p>

        <form method="post" action="/page-b/download">
            <button type="submit">Download</button>
        </form>
    </main>
</body>
</html>