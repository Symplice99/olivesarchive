<?php

use App\Models\Cour;
use App\Models\Niveau;
use App\Models\Domaine;
use App\Models\Epreuve;
use App\Models\Matiere;
use App\Models\Exercice;
use App\Models\Correction;
use Illuminate\Support\Facades\DB;

    function getCours(){
        $cours=Cour::all();
        //dd($cours);
        return $cours;
    }


    function getEpreuves(){
        $epreuves=Epreuve::all();
        //dd($epreuves);
        return $epreuves;
    }


    function getExercices(){
        $exercice=Exercice::all();
        //dd($exercice);
        return $exercice;
    }

    function getCorrection(){
        $corrections=Correction::all();
        //dd($corrections);
        return $corrections;
    }

    function getDomaine(){
        $domaines=Domaine::all();
        //dd($corrections);
        return $domaines;
    }

    function countNiveau(){
        $cn=Niveau::count();
        //dd($cn);
        return $cn;
    }

    function countDomaine(){
        $cd=Domaine::count();
        //dd($cd);
        return $cd;
    }

    function countMatiere(){
        $cm=Matiere::count();
        //dd($cm);
        return $cm;
    }

    function countCours(){
        $cc=Cour::count();
        //dd($cc);
        return $cc;
    }

    function countEpreuve(){
        $cep=Epreuve::count();
        //dd($cep);
        return $cep;
    }

    function countExercice(){
        $cex=Exercice::count();
        //dd($cex);
        return $cex;
    }

    function countCorrectonExo(){
        $correction=DB::table('corrections')
        ->join('exercices', 'corrections.exercice_id', '=', 'exercices.id' )
        ->select('corrections.*', DB::raw('COUNT(corrections.exercice_id) as exercices_count'));
        return $correction;

    }

    function countCorrectonEp(){
        $correction=DB::table('corrections')
        ->join('epreuves', 'corrections.epreuve_id', '=', 'epreuves.id' )
        ->select(DB::raw('COUNT(corrections.epreuve_id) as epreuves_count'));
        return $correction;
    }


?>
