<?php

namespace Tunglam\BasicPhp2\Controllers\Admin;

use Tunglam\BasicPhp2\Commons\Controller;

class DashboardController extends Controller
{
     public function dashboard()
     {
         $this->renderViewAdmin(__FUNCTION__);
     }
}
