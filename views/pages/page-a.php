<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page A</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f5f7; margin: 0; }
        nav { background: #fff; padding: 1rem 2rem; box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06); display: flex; gap: 1.5rem; align-items: center; }
        nav a { color: #2563eb; text-decoration: none; }
        nav .user { margin-left: auto; color: #555; }
        main { max-width: 600px; margin: 3rem auto; background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); text-align: center; }
        button { padding: 0.8rem 1.6rem; border: 0; border-radius: 4px; background: #2563eb; color: #fff; font-size: 1rem; cursor: pointer; }
        button:hover { background: #1d4ed8; }
        .thank-you { font-size: 1.5rem; color: #166534; }
    </style>
</head>
<body>
    <nav>
        <a href="/page-a">Page A</a>
        <a href="/page-b">Page B</a>
        <span class="user">Hi, <?= $this->e($user['name']) ?></span>
        <form method="post" action="/logout" class="logout">
            <button type="submit">Logout</button>
        </form>
    </nav>

    <main>
        <h1>Page A</h1>

        <button type="button" id="buy-cow">Buy a cow</button>
        <p class="thank-you" id="thank-you" hidden>thankYou</p>
    </main>

    <script>
        document.getElementById('buy-cow').addEventListener('click', async () => {
            const response = await fetch('/page-a/buy', { method: 'POST' });

            if (response.status === 201) {
                document.getElementById('buy-cow').remove();
                document.getElementById('thank-you').hidden = false;
            }
        });
    </script>
</body>
</html>