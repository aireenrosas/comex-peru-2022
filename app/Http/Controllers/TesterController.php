<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Conexiones;
use DB;
use Auth;
use App\CompanyItemSearched;
use App\CompanyHomeCategory;
use App\Companies;
use App\JobOpening;
use App\Tag;
use Funciones;
use App;
use App\Article;
use App\User;
use App\Slider;
use App\Subscriber;

class TesterController extends Controller
{

    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return 1;
    }


}
