<?php
namespace App\Controllers;

use App\Services\Database;
use App\Services\ImageManager;
use Delight\Auth\Auth;
use League\Plates\Engine;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;
use BlueM;

class KursesController extends Controller
{
    public function kurses()
    {

        $link_kurses = substr($_SERVER['REQUEST_URI'],8);

        $link = $this->database->out_link_kurses($link_kurses);

        $URL = (!empty($link['link'])) ? $link['link'] : "http://sintezmlm";
       // dd($URL);

        header("Location:$URL");

    }
}