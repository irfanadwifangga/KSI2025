<?php
// index.php - Menampilkan daftar mahasiswa dengan Bootstrap
$students = require __DIR__ . '/data/students.php';

// Simple search (by nama atau nim)
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
if ($q !== '') {
    $qLower = mb_strtolower($q);
    $filtered = array_filter($students, function ($s) use ($qLower) {
        return mb_stripos($s['nama'], $qLower) !== false || mb_stripos($s['nim'], $qLower) !== false;
    });
} else {
    $filtered = $students;
}

// Pagination (simple)
$perPage = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$total = count($filtered);
$pages = (int)ceil($total / $perPage);
if ($page < 1) $page = 1;
if ($page > $pages) $page = $pages;
$start = ($page - 1) * $perPage;
$pagedData = array_slice(array_values($filtered), $start, $perPage);

require __DIR__ . '/includes/header.php';
?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Daftar Mahasiswa</h1>
        <form class="form-inline" method="get" style="max-width:400px;">
            <div class="input-group">
                <input type="search" name="q" class="form-control" placeholder="Cari nama atau NIM" value="<?php echo htmlspecialchars($q); ?>">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </form>
    </div>

    <p class="text-muted">Menampilkan <?php echo count($pagedData); ?> dari <?php echo $total; ?> hasil.</p>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Angkatan</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pagedData as $s): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($s['nim']); ?></td>
                        <td><?php echo htmlspecialchars($s['nama']); ?></td>
                        <td><?php echo htmlspecialchars($s['jurusan']); ?></td>
                        <td><?php echo htmlspecialchars($s['angkatan']); ?></td>
                        <td><a href="mailto:<?php echo htmlspecialchars($s['email']); ?>"><?php echo htmlspecialchars($s['email']); ?></a></td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($pagedData)): ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($pages > 1): ?>
        <nav>
            <ul class="pagination">
                <?php for ($p = 1; $p <= $pages; $p++): ?>
                    <li class="page-item <?php echo $p === $page ? 'active' : ''; ?>">
                        <a class="page-link" href="?<?php
                                                    $qs = [];
                                                    if ($q !== '') $qs['q'] = $q;
                                                    $qs['page'] = $p;
                                                    echo http_build_query($qs);
                                                    ?>"><?php echo $p; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>

</div>

<?php require __DIR__ . '/includes/footer.php';
