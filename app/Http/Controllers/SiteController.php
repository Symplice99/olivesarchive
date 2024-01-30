<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use App\Models\Niveau;
use App\Models\Domaine;
use App\Models\Epreuve;
use App\Models\Exercice;
use Illuminate\View\View;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function indexAccueil():View{
        return view('SITE.PAGES.accueil');
    }


    // liste des cours
    public function indexAccueilCours():View{
        //dd($domaines);
        $cours=Cour::all();
        $niveaux=Niveau::all();
        // $domaines=Domaine::all();
        return view('SITE.PAGES.accueilCours', compact( 'cours', 'niveaux'));
    }


    //détail sur les cours
    public function indexAccueilCoursDetail($id){
        $cour=Cour::find($id);
        return view('SITE.PAGES.accueilCoursDetail', compact('cour'));
    }


    //liste des épreuves
    public function indexAccueilDevoir():View{
        $epreuves=Epreuve::all();
        return view('SITE.PAGES.accueilDevoir', compact('epreuves'));
    }


    //liste des exercices
    public function indexAccueilDevoir2():View{
        //$exercices=Exercice::all();
        return view('SITE.PAGES.accueilDevoir2');
    }


    //détail sur les épreuves
    public function indexAccueilDevoirDetail($id){
        $epreuve=Epreuve::find($id);
        return view('SITE.PAGES.accueilDevoirDetail', compact('epreuve'));
    }


    //détail sur les exercices
    public function indexAccueilDevoirDetail2($id){
        $exercice=Exercice::find($id);
        return view('SITE.PAGES.accueilDevoirDetail2', compact('exercice'));
    }






}
