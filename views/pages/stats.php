<?php require __DIR__ . '/../layout/header.php'; ?>

    <main class="wide">
        <h1 class="h3 mb-4">User activity</h1>

        <form method="get" action="/stats" class="row g-3 align-items-end mb-4">
            <div class="col-md-2">
                <label class="form-label" for="date_from">From</label>
                <input type="date" class="form-control" id="date_from" name="date_from"
                       value="<?= $this->e($filters['date_from'] ?? '') ?>">
            </div>

            <div class="col-md-2">
                <label class="form-label" for="date_to">To</label>
                <input type="date" class="form-control" id="date_to" name="date_to"
                       value="<?= $this->e($filters['date_to'] ?? '') ?>">
            </div>

            <div class="col-md-3">
                <label class="form-label" for="user_id">User</label>
                <select class="form-select" id="user_id" name="user_id">
                    <option value="">All users</option>
                    <?php foreach ($users as $u): ?>
                        <option value="<?= $this->e($u['id']) ?>" <?= $filters['user_id'] === $u['id'] ? 'selected' : '' ?>>
                            <?= $this->e($u['name']) ?> (<?= $this->e($u['email']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label" for="action">Action</label>
                <select class="form-select" id="action" name="action">
                    <option value="">All actions</option>
                    <?php foreach ($actions as $action): ?>
                        <option value="<?= $this->e($action->value) ?>" <?= $filters['action'] === $action->value ? 'selected' : '' ?>>
                            <?= $this->e($action->value) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="/stats" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>

        <p class="text-muted small">Showing <?= count($events) ?> latest events (max 100).</p>

        <?php if ($events === []): ?>
            <div class="alert alert-light border">No events found.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Target</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $event): ?>
                            <?php
                            $badge = match ($event['event_type']) {
                                'login'        => 'success',
                                'logout'       => 'secondary',
                                'registration' => 'primary',
                                'view_page'    => 'info',
                                'button_click' => 'warning',
                                default        => 'light',
                            };
                            ?>
                            <tr>
                                <td class="text-nowrap"><?= $this->e($event['created_at']) ?></td>
                                <td>
                                    <?= $this->e($event['user_name'] ?? 'Deleted user') ?>
                                    <div class="text-muted small"><?= $this->e($event['user_email'] ?? '') ?></div>
                                </td>
                                <td><span class="badge text-bg-<?= $badge ?>"><?= $this->e($event['event_type']) ?></span></td>
                                <td><?= $this->e($event['target'] ?? '—') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>