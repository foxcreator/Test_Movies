<?php

namespace App\Controllers;

use App\Models\Movie;
use Core\Controller;
use Core\View;

class MainController extends Controller
{

    public function index()
    {
        $paginateData = Movie::paginate(6);
        $movies = $paginateData['movies'];
        View::render('index', compact('movies', 'paginateData'));
    }

    public function createForm()
    {
        View::render('createmovie');
    }

    public function updateForm($id)
    {
        $movie = Movie::find($id);
        View::render('updatemovie', compact('movie'));
    }

    public function show(int $id)
    {
        $movie = Movie::find($id);
        View::render('show', compact('movie'));
    }
}