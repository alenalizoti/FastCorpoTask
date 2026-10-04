<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <style>
        body {
            font-family: system-ui, sans-serif;
            background: #f4f5f7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .card {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 360px;
        }

        h1 {
            margin-top: 0;
            font-size: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        input {
            display: block;
            width: 100%;
            box-sizing: border-box;
            margin-top: 0.3rem;
            padding: 0.6rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        button {
            width: 100%;
            padding: 0.7rem;
            border: 0;
            border-radius: 4px;
            background: #2563eb;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        p {
            text-align: center;
            font-size: 0.9rem;
        }
        .error {
            display: block;
            margin-top: 0.3rem;
            color: #dc2626;
            font-size: 0.8rem;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Create an account</h1>

        <form method="post" action="/register">
            <label>
                Name
                <input type="text" name="name" required maxlength="100" autocomplete="name"
                    value="<?= $this->e($old['name'] ?? '') ?>">
                <?php if (isset($errors['name'])): ?>
                    <span class="error"><?= $this->e($errors['name']) ?></span>
                <?php endif; ?>
            </label>

            <label>
                Email
                <input type="email" name="email" required maxlength="255" autocomplete="email"
                    value="<?= $this->e($old['email'] ?? '') ?>">
                <?php if (isset($errors['email'])): ?>
                    <span class="error"><?= $this->e($errors['email']) ?></span>
                <?php endif; ?>
            </label>

            <label>
                Password
                <input type="password" name="password" required minlength="8" autocomplete="new-password">
                <?php if (isset($errors['password'])): ?>
                    <span class="error"><?= $this->e($errors['password']) ?></span>
                <?php endif; ?>
            </label>

            <button type="submit">Register</button>
        </form>

        <p>Already have an account? <a href="/login">Log in</a></p>
    </div>
</body>

</html>