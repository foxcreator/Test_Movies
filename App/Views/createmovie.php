<?php \Core\View::render('layouts/header');?>



<section class="create pt-5">
    <div class="container">
        <h1 class="header-title">Add Movies</h1>
        <div class="home-box">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <form action="<?= SITE_URL . '/create' ?>" method="POST" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text"
                                       name="title"
                                       class="form-control"
                                       id="title"
                                       value="<?= !empty($title) ? $title : '' ?>"
                                       required>
                                <?php if (!empty($title_error)): ?>
                                    <div class="alert alert-danger col-sm-12" role="alert">
                                        <?= $title_error  ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control"
                                          name="description"
                                          id="description" style="height: 100px"
                                          required><?= !empty($description) ? $description : '' ?></textarea>
                                <?php if (!empty($description_error)): ?>
                                    <div class="alert alert-danger col-sm-12" role="alert">
                                        <?= $description_error  ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <label for="date" class="col-sm-2 col-form-label">Reliase date</label>
                            <div class="col-sm-10">
                                <input type="date"
                                       name="date"
                                       class="form-control"
                                       id="date"
                                       value="<?= !empty($date) ? $date : '' ?>"
                                       required>
                                <?php if (!empty($date_error)): ?>
                                    <div class="alert alert-danger col-sm-12" role="alert">
                                        <?= $date_error ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label for="formFile" class="col-sm-2 col-form-label">Poster</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="image" type="file" id="image" required>
                                <?php if (!empty($image_error)): ?>
                                    <div class="alert alert-danger col-sm-12" role="alert">
                                        <?= $image_error ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="btn-form">
                            <button type="submit" class="btn btn-dark">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php \Core\View::render('layouts/footer');?>
