<?php \Core\View::render('layouts/header');
?>



<section class="create pt-5">
    <div class="container">
        <h1 class="header-title">Edit Movie</h1>
        <div class="home-box">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <form action="<?php SITE_URL . '/update/' . $movie->id; ?>" method="POST" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text"
                                       name="title"
                                       class="form-control"
                                       id="title"
                                       value="<?= isset($data['title']) ? $data['title'] : $movie->title; ?>"
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
                                          required><?= !empty($movie->description) ? $movie->description : '' ?></textarea>
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
                                       value="<?= !empty($movie->date) ? $movie->date : '' ?>"
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
                                <input class="form-control" name="image" accept=".jpeg, .png, .jpg" type="file" id="image">
                                <?php if (!empty($image_error)): ?>
                                    <div class="alert alert-danger col-sm-12" role="alert">
                                        <?= $image_error ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                        <div class="btn-form">
                            <button type="submit" class="btn btn-dark">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php \Core\View::render('layouts/footer');?>

