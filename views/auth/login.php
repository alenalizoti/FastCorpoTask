<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f5f7; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); width: 100%; max-width: 360px; }
        h1 { margin-top: 0; font-size: 1.5rem; }
        label { display: block; margin-bottom: 1rem; font-size: 0.9rem; }
        input { display: block; width: 100%; box-sizing: border-box; margin-top: 0.3rem; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px; font-size: 1rem; }
        button { width: 100%; padding: 0.7rem; border: 0; border-radius: 4px; background: #2563eb; color: #fff; font-size: 1rem; cursor: pointer; }
        button:hover { background: #1d4ed8; }
        p { text-align: center; font-size: 0.9rem; }
        .error { display: block; margin-top: 0.3rem; color: #dc2626; font-size: 0.8rem; }
        .success { background: #dcfce7; color: #166534; padding: 0.6rem; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Log in</h1>

        <?php if (!empty($registered)): ?>
            <p class="success">Account created. Please log in.</p>
        <?php endif; ?>

        <form method="post" action="/login">
            <label>
                Email
                <input type="email" name="email" required autocomplete="email"
                       value="<?= $this->e($old['email'] ?? '') ?>">
                <?php if (isset($errors['email'])): ?>
                    <span class="error"><?= $this->e($errors['email']) ?></span>
                <?php endif; ?>
            </label>

            <label>
                Password
                <input type="password" name="password" required autocomplete="current-password">
            </label>

            <button type="submit">Log in</button>
        </form>

        <p>Don't have an account? <a href="/register">Register</a></p>
    </div>
</body>
</html>