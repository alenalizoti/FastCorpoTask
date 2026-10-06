<?php
$title = 'Page A';
require_once __DIR__ . '/../layout/header.php';
?>
    <main>
        <h1>Page A</h1>

        <button type="button" id="buy-cow">Buy a cow</button>
        <p class="thank-you" id="thank-you" hidden>thankYou</p>
    </main>

    <script>
        document.getElementById('buy-cow').addEventListener('click', async () => {
            const response = await fetch('/page-a/buy', {
                method: 'POST',
                body: new URLSearchParams({ _csrf: '<?= $this->e($_SESSION['csrf']) ?>' }),
            });

            if (response.status === 201) {
                document.getElementById('buy-cow').remove();
                document.getElementById('thank-you').hidden = false;
            }
        });
    </script>
</body>
</html>