<?php

namespace App\Http\Controllers;

use App\Models\Epreuve;
use App\Models\Exercice;
use Illuminate\View\View;
use App\Models\Correction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class CorrectionController extends Controller
{


    public function create($id):View{
        //dd($id);
        $epreuve=Epreuve::find($id);
         return view('DASHBOARD.PAGES.createCorrection',compact('epreuve'));
    }

    public function create2($id):View{
        //dd($id);
        $exercice=Exercice::find($id);
         return view('DASHBOARD.PAGES.createCorrectionExo',compact('exercice'));
    }

    public function store(Request $request, $id){
        //dd($request);
        $epreuve=Epreuve::find($id);
        $count = DB::table('corrections')
        ->select(DB::raw('COUNT(epreuve_id) as epreuve_count'))
        ->where('epreuve_id', $epreuve->id)
        ->groupBy('epreuve_id')
        ->first();
        //dd($count->epreuve_count);
         $request->validate([

             'montantCorrection' => ['required', 'integer'],
             'fichierCorrection' => ['required', 'mimes:pdf'],
        ]);
        $chemin_fichier=$request->fichierCorrection->store('CorrectionEpreuves');
        //dd($chemin_fichier);


        if($count && $count->epreuve_count !== 0){
            return redirect()->route('epreuves.index')->with('error', 'Une correction assossiée à l\'épreuve n° '.$epreuve->id.' a déjà été ajouté.');
        }else{

            $corrections = Correction::create([
                'fichiercor' =>$chemin_fichier,
                'montant' => $request->montantCorrection,
                'epreuve_id'=>$epreuve->id,
            ]);
            return redirect()->route('epreuves.index')->with('success', 'La correction de l\'épreuve n°'.$epreuve->id.'  a été ajouté avec succès.');
        }

    }

    public function store2(Request $request, $id){
        //dd($request);
        $exercice=Exercice::find($id);
        $count = DB::table('corrections')
        ->select(DB::raw('COUNT(exercice_id) as exercice_count'))
        ->where('exercice_id', $exercice->id)
        ->groupBy('exercice_id')
        ->first();
        //dd($count->epreuve_count);
         $request->validate([

             'montantCorrection' => ['required', 'integer'],
             'fichierCorrection' => ['required', 'mimes:pdf'],
        ]);
        $chemin_fichier=$request->fichierCorrection->store('CorrectionExos');
        //dd($chemin_fichier);


        if($count && $count->exercice_count!== 0){
            return redirect()->route('exercices.index')->with('error', 'Une correction assossiée à l\'exercice n° '.$exercice->id.' a déjà été ajouté.');
        }else{

            $corrections = Correction::create([
                'fichiercor' =>$chemin_fichier,
                'montant' => $request->montantCorrection,
                'exercice_id'=>$exercice->id,
            ]);
            return redirect()->route('exercices.index')->with('success', 'La correction de l\'exercice n°'.$exercice->id.'  a été ajouté avec succès.');
        }

    }

    public function index(){
        $corrections=Correction::all();
        //$epreuves = Epreuve::with('devoir')->get();
         //dd($epreuves);
         return view('DASHBOARD.PAGES.indexcorrection',compact('corrections'));
    }


    public function destroy($id){

        try {
            // Suppression de l'élément
            $corrections=Correction::findOrFail($id);
            // Vérifier si le cours existe
            if (!$corrections) {
                return back()->with('error', "La correction n'existe pas.");
            }

            // Récupérer le nom du fichier
            $nomFichier = $corrections->fichierdev;
            // Supprimer le fichier du dossier storage
             $cheminFichier = 'storage/' . $nomFichier;
            //dd($cheminFichier);

            if (Storage::exists($cheminFichier)) {
                Storage::delete($cheminFichier);
            }

            // Supprimer l'épreuve de la base de données
            $corrections->delete();

            // Autres actions après la suppression réussie, si nécessaire

            return redirect()->route('corrections.index')->with('success', 'L\'élément a été supprimé avec succès.');
        }
        catch (QueryException $e) {
            // Gestion de l'exception liée à la clé étrangère
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                // Code d'erreur 1451 : violation de clé étrangère
                return redirect()->back()->with('error', 'Impossible de supprimer cet élément car il est référencé dans une autre table.');
            } else {
                // Gestion d'autres erreurs de requête, si nécessaire
                return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la suppression de l\'élément.');
            }
        }




    }

    public function edit($id){
        $corrections=Correction::find($id);
       return view('DASHBOARD.PAGES.editCorrection', compact('corrections'));
    }


    public function update(Request $request,$id)
    {
        $rules=[
            'montantCorrection' => ['required', 'integer'],
        ];
        if ($request->has("fichierCorrection")) {
            $rules["fichierCorrection"]=['mimes:pdf'];
        }
        $this->validate($request, $rules);

        $corrections=Correction::find($id);
        $ancienCheminImage = $corrections->fichiercor; //récupération de l'ancien fichier
        if ($request->has("fichierCorrection")) {
            // Si un nouveau fichier est téléchargé, supprimer l'ancien fichier et enregistrer le nouveau
            Storage::delete($ancienCheminImage);//supprimer l'image
            $chemin_image=$request->fichierCorrection->store("corrections");
        }else{
            // Si aucun nouveau fichier n'est téléchargé, conserver l'ancien chemin d'image
            $chemin_image = $ancienCheminImage;
        }
        //dd($chemin_image);
        $request->validate([
            'montantCorrection' => ['required', 'integer'],
            'fichierEpreuve' => ['mimes:pdf'],
        ]);
        $corrections->update([

            'fichiercor' =>$chemin_image,
            'montant' => $request->montantCorrection,
        ]);
        return redirect()->route('corrections.index')->with('success', 'L\'élément a été modifié avec succès.');

    }
}
