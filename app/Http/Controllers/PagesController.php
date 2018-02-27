<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;


class PagesController extends Controller
{
    public function index(){
        return view ('pages.index');
    }

    public function about(){
        $title ='Over Vlindr';
        return view ('pages.about')->with('title', $title);
    }

    public function future(){
        $title = 'De toekomst';
        return view ('pages.future')->with('title', $title);
    }

    public function volunteer(){
        return view ('pages.volunteer');
    }

    public function contact(){
      $title = 'Contact met Vlindr';
        return view ('pages.contact')->with('title', $title);
    }



}
