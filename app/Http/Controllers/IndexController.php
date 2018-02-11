<?php

namespace Radiophonix\Http\Controllers;

class IndexController extends Controller
{
    public function __invoke()
    {
        return file_get_contents(__DIR__ . '/../../../public/index.html');
    }
}
