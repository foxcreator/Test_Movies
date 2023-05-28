<?php

namespace App\Controllers;

use App\Models\Movie;
use App\Validators\CreateMovieValidator;
use App\Validators\UpdateMovieValidator;
use Core\Controller;
use Core\FileUploadService;
use Core\Model;
use Core\View;

class MovieController extends Controller
{

    public function create()
    {
        $fields = filter_input_array(INPUT_POST, $_POST, 1);
        $fields['image'] = $_FILES['image']['name'];



        $uploader = new FileUploadService();
        $validator = new CreateMovieValidator();
        if ($validator->validate($fields)) {
            $imagePath = $uploader->uploadImage($_FILES['image']);
            $fields['image'] = $imagePath;
            Movie::save($fields);
            redirect();
        }

        $this->data = $fields;
        $this->data += $validator->getError();

        View::render('createmovie', $this->data);
    }

    public function delete(int $id)
    {
        $movie = Movie::find($id);
        $file = new FileUploadService();
        $file->deleteFile($movie->image);
        Movie::delete($id);
        redirect();
    }



    public function update($id)
    {
        $movie = Movie::find($id);

        $fields = filter_input_array(INPUT_POST, $_POST, 1);
        $fields['image'] = $_FILES['image']['name'];

        $validator = new UpdateMovieValidator();
        $uploader = new FileUploadService();
        if ($validator->validate($fields)) {

            if (isset($fields['image'])) {
                $uploader->deleteFile($movie->image);
                $imagePath = $uploader->uploadImage($_FILES['image']);
                $fields['image'] = $imagePath;
            } else {
                $fields['image'] = $movie->image;
            }

            $movie->update($fields, $movie->id);
            redirect('');
        }

        $this->data = $fields;
        $this->data += $validator->getError();
        View::render('updatemovie', ['data' => $this->data, 'movie' => $movie]);

    }
}