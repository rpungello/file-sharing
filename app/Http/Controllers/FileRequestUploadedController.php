<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

class FileRequestUploadedController extends Controller
{
    public function __invoke(): Response
    {
        return response()->view('request-uploaded');
    }
}
