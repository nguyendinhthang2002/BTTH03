<?php
class AuthorController
{
    public function index()
    {
        $authors = Author::getAll();
        // Render a Twig template with the list of users
        // ...
    }

    public function add()
    {
        $author = Author::add();
    }

    public function edit($id)
    {
        $author = Author::getById($id);
        $author->edit();
    }

    public function delete($id)
    {
        $author = Author::getById($id);
        $author->delete();
    }
}