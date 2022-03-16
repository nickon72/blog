<?php

namespace App\Controllers\Admin;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;
use BlueM;

class CommentsController extends Controller
{
    public function index()
    {
    	$comments = $this->database->all('comments');

        echo $this->view->render('admin/comments/index', ['comments' =>  $comments]);

    }


    public function toggle_on($id)
    {
    	$this->database->toggle_on('comments',$id);

    	return back();
    }

    public function toggle_off($id)
    {
        $this->database->toggle_off('comments',$id);

        return back();
    }

    public function delete($id)
    {
        $this->database->delete('comments', $id);
        return back();
    }

}
