<?php \Core\View::render('layouts/header'); ?>

<section class="show pt-5">
    <img src="<?= ASSET_URL . $movie->image ?>" alt=".." class="back-image">
    <div class="container mt-5">

<!--        <h1 class="header-title">All Movies</h1>-->
        <div class="home-box">
            <div class="row">
                <div class="col-md-4" >
                    <img src="<?= ASSET_URL . $movie->image ?>" alt="Not found..." class="img-fluid show-poster" >
                </div>
                <div class="col-md-4 text-start">
                    <h1 class="title"><?= $movie->title ?></h1>
                    <div class="date">Reliase date: <?= $movie->date ?></div>
                    <div class="description">
                        <p>Overview:</p>
                        <?= $movie->description ?>
                    </div>

                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </div>

</section>

<?php \Core\View::render('layouts/footer');?>

