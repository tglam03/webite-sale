<?php

namespace Tunglam\BasicPhp2\Controllers\Admin;


use Rakit\Validation\Validator;
use Tunglam\BasicPhp2\Models\User;
use Tunglam\BasicPhp2\Commons\Helper;
use Tunglam\BasicPhp2\Commons\Controller;


class ThongkeController extends Controller
{
    public function thongke()
    {
        $this->renderViewAdmin(__FUNCTION__);
    }
}
