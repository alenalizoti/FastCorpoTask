<?php require __DIR__ . '/../layout/header.php'; ?>

    <main class="wide">
        <h1 class="h3 mb-1">Reports</h1>
        <p class="text-muted small mb-4">
            <?= $this->e($from) ?> – <?= $this->e($to) ?> (last 30 days)
        </p>

        <div class="card mb-4">
            <div class="card-body">
                <canvas id="report-chart" height="110"></canvas>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th class="text-end">Page A views</th>
                        <th class="text-end">Page B views</th>
                        <th class="text-end">"Buy a cow" clicks</th>
                        <th class="text-end">"Download" clicks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (array_reverse($report) as $row): ?>
                        <tr>
                            <td><?= $this->e($row['day']) ?></td>
                            <td class="text-end"><?= $row['page_a_views'] ?></td>
                            <td class="text-end"><?= $row['page_b_views'] ?></td>
                            <td class="text-end"><?= $row['buy_cow_clicks'] ?></td>
                            <td class="text-end"><?= $row['download_clicks'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="fw-semibold">
                    <tr>
                        <td>Total</td>
                        <td class="text-end"><?= array_sum(array_column($report, 'page_a_views')) ?></td>
                        <td class="text-end"><?= array_sum(array_column($report, 'page_b_views')) ?></td>
                        <td class="text-end"><?= array_sum(array_column($report, 'buy_cow_clicks')) ?></td>
                        <td class="text-end"><?= array_sum(array_column($report, 'download_clicks')) ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        const report = <?= json_encode($report, JSON_THROW_ON_ERROR | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

        new Chart(document.getElementById('report-chart'), {
            type: 'line',
            data: {
                labels: report.map(row => row.day),
                datasets: [
                    { label: 'Page A views',       data: report.map(row => row.page_a_views) },
                    { label: 'Page B views',       data: report.map(row => row.page_b_views) },
                    { label: '"Buy a cow" clicks', data: report.map(row => row.buy_cow_clicks) },
                    { label: '"Download" clicks',  data: report.map(row => row.download_clicks) },
                ],
            },
            options: {
                scales: { y: { beginAtZero: true, ticks: { precision: 0 } } },
                interaction: { mode: 'index', intersect: false },
            },
        });
    </script>
</body>
</html>