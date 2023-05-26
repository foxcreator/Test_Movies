<?php \Core\View::render('layouts/header'); ?>

<section class="home">
<div class="container">
<h1 class="header-title">All Movies</h1>
    <div class="home-box">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php foreach ($movies as $movie) { ?>
            <div class="col">
                <div class="card mb-3 bg-dark-subtle" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?= ASSET_URL . $movie->image ?>" class="img-thumbnail rounded-start poster" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= $movie->title ?></h5>
                                <p class="card-text"><small class="text-body-secondary">Relise Date: <?= $movie->date ?></small></p>

                                <div class="row mt-5 pt-2">
                                    <div class="col-md-6">
                                        <a href="<?= SITE_URL . '/updatemovie/' . $movie->id ?>">
                                            <button type="button" class="btn btn-success">Edit info</button>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="<?= SITE_URL . '/movie/delete/' . $movie->id ?>">
                                            <button type="button" class="btn btn-danger" >Delete movie</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="row mb-0 mt-2">
                                    <div class="col-md-12">
                                        <a href="<?= SITE_URL . '/movies/' . $movie->id ?>">
                                            <button type="button" class="btn btn-secondary">Information</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php };?>

        </div>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation">
                <ul class="pagination ">
                    <li class="page-item">
                        <a class="page-link bg-dark" href="?page=<?= $paginateData['currentPage']  > 1 ? $paginateData['currentPage'] - 1 : $paginateData['currentPage'] ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $paginateData['totalPages']; $i++) : ?>
                        <li class="page-item <?php $paginateData['currentPage'] === $i ?? 'active'; ?>">
                            <a class="page-link bg-dark" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php
                    endfor; ?>
                    <li class="page-item">
                        <a class="page-link bg-dark" href="?page=<?= $paginateData['currentPage'] < $paginateData['totalPages'] ? $paginateData['currentPage'] + 1 : $paginateData['currentPage'] ?>">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</div>

</section>

<?php \Core\View::render('layouts/footer');?>
