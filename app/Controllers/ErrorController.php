<?php

namespace App\Controllers;

class ErrorController extends ViewController
{
    public function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        $this->render('error/404');
        exit;
    }

    public function forbidden()
    {
        header("HTTP/1.0 403 Forbidden");
        $this->render('error/403');
        exit;
    }

    public function internalServerError()
    {
        header("HTTP/1.0 500 Internal Server Error");
        $this->render('error/500');
        exit;
    }

    public function badRequest()
    {
        header("HTTP/1.0 400 Bad Request");
        $this->render('error/400');
        exit;
    }

    public function unauthorized()
    {
        header("HTTP/1.0 401 Unauthorized");
        $this->render('error/401');
        exit;
    }

    public function requestTimeout()
    {
        header("HTTP/1.0 408 Request Timeout");
        $this->render('error/408');
        exit;
    }

    public function serviceUnavailable()
    {
        header("HTTP/1.0 503 Service Unavailable");
        $this->render('error/503');
        exit;
    }
}