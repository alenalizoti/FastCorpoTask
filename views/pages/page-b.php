<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page B</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f5f7; margin: 0; }
        nav { background: #fff; padding: 1rem 2rem; box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06); display: flex; gap: 1.5rem; align-items: center; }
        nav a { color: #2563eb; text-decoration: none; }
        nav a.active { font-weight: 600; }
        nav .user { margin-left: auto; color: #555; }
        main { max-width: 600px; margin: 3rem auto; background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); text-align: center; }
        p { color: #555; }
        button { padding: 0.8rem 1.6rem; border: 0; border-radius: 4px; background: #2563eb; color: #fff; font-size: 1rem; cursor: pointer; }
        button:hover { background: #1d4ed8; }
    </style>
</head>
<body>
    <nav>
        <a href="/page-a">Page A</a>
        <a href="/page-b" class="active">Page B</a>
        <span class="user">Hi, <?= $this->e($user['name']) ?></span>
    </nav>

    <main>
        <h1>Page B</h1>
        <p>Click the button below to download the file.</p>

        <form method="post" action="/page-b/download">
            <button type="submit">Download</button>
        </form>
    </main>
</body>
</html>