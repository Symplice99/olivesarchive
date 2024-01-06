<?php

namespace App\Http\Controllers;

use App\Models\Devoir;
use App\Models\Matiere;
use App\Models\Exercice;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class ExerciceController extends Controller
{
    // Fonction pour formater la taille en octets en une chaîne lisible
    function formatBytes($bytes, $precision = 2) {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function create():View{
        $matieres=Matiere::all();
        return view('DASHBOARD.PAGES.createExercice', compact('matieres'));
    }

    public function store(Request $request){
        $request->validate([

            'nomMatiereExercice' => ['required', 'string'],
            'typeExercice' => ['required'],
            'filiereExercice' => ['required', 'string', 'max:60'],
            'autreMat' => ['max:100'],
            'descriptionExercice' => ['required', 'string'],
            'sourceExercice' => ['required', 'string', 'max:70'],
            'complexiteExercice' => ['required'],
            'prixExercice' => ['required', 'string'],
            'fichierExercice' => ['required', 'mimes:pdf'],
        ]);
        //dd($request);

        if ($request->autreMat==null) {
            $autre="Aucune";
        }else{
            $autre=$request->autreMat;
        }
        $chemin_fichier=$request->fichierExercice->store('exercices');

        // Récupérez la taille du fichier en octets
        $tailleDuFichierOctets = Storage::size($chemin_fichier);

        // Convertissez la taille du fichier en unités plus conviviales (ko, Mo, Go, etc.)
        $tailleDuFichierLisible = $this->formatBytes($tailleDuFichierOctets);
        //$tailleDuFichierMo = $this->convertirEnMo($tailleDuFichierOctets);

        $devoirs = Devoir::create([

            'matiere_id' => $request->nomMatiereExercice,
            'autre' =>$autre,
            'description' => $request->descriptionExercice,
            'complexite' => $request->complexiteExercice,
            'filiere' => $request->filiereExercice,
            'type' => $request->typeExercice,
            'fichierdev' => $chemin_fichier,
            'taille' => $tailleDuFichierLisible,
            'tarif' => $request->prixExercice,

            //'taile' => $tailleDuFichierLisible,
        ]);

        $exercices = Exercice::create([

            'source' => $request->sourceExercice,
            'devoir_id' => $devoirs->id,
        ]);
        $devoirs->devoirable()->associate($exercices); // Associez l'Epreuve au Devoir
        $devoirs->save();// Sauvegardez le Devoir pour enregistrer l'association
        //return back();
        return Redirect()->route('exercices.index')->with('success'," Vous avez ajouté un exercice avec succès");
    }

    public function index(){
        $exercices=Exercice::all();
         return view('DASHBOARD.PAGES.indexExercice',compact('exercices'));
    }

    public function destroy($id){
        try {
            // Récupérer le cours à supprimer
            $exercices = Exercice::findOrFail($id);
            //dd($exercices->);

            // Vérifier si le cours existe
            if (!$exercices) {
                return back()->with('error', "L'épreuve n'existe pas.");
            }

            // Récupérer le nom du fichier
            $nomFichier = $exercices->fichierdev;
            // Supprimer le fichier du dossier storage
              $cheminFichier = 'storage/' . $nomFichier;
            //dd($cheminFichier);

            if (Storage::exists($cheminFichier)) {
                Storage::delete($cheminFichier);
            }

            // Supprimer l'épreuve de la base de données
            $exercices->delete();

            // Supprimer le devoir assosié de la base de données
            if ($exercices->devoir) {
                $exercices->devoir->delete();
            }
            return back()->with('success', "L'exercice a été supprimé avec succès.");

        } catch (QueryException $e) {
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
        $matieres=Matiere::all();

       $exercices=Exercice::find($id);
       return view('DASHBOARD.PAGES.editExercice', compact('exercices','matieres'));
    }

    public function update(Request $request,$id)
    {
        $rules=[
            'nomMatiereExercice' => ['required', 'string'],
            'typeExercice' => ['required'],
            'filiereExercice' => ['required', 'string', 'max:60'],
            'autreMat' => ['max:100'],
            'descriptionExercice' => ['required', 'string'],
            'sourceExercice' => ['required', 'string', 'max:70'],
            'complexiteExercice' => ['required'],
            'prixExercice' => ['required', 'string'],
        ];

        if ($request->has("fichierExercice")) {
            $rules["fichierExercice"]=['mimes:pdf'];
        }
        $this->validate($request, $rules);

        $devoirs=Devoir::find($id)->where('devoirable_type', '=', 'App\Models\Exercice')->first();
        //dd($devoirs);
        $ancienCheminImage = $devoirs->fichierdev; //récupération de l'ancien fichier
        if ($request->has("fichierExercice")) {
            // Si un nouveau fichier est téléchargé, supprimer l'ancien fichier et enregistrer le nouveau
            Storage::delete($ancienCheminImage);//supprimer l'image
            $chemin_image=$request->fichierExercice->store("exercices");
        }else{
            // Si aucun nouveau fichier n'est téléchargé, conserver l'ancien chemin d'image
            $chemin_image = $ancienCheminImage;
        }

        $request->validate([
            'nomMatiereExercice' => ['required', 'string'],
            'typeExercice' => ['required'],
            'filiereExercice' => ['required', 'string', 'max:60'],
            'autreMat' => ['max:100'],
            'descriptionExercice' => ['required', 'string'],
            'sourceExercice' => ['required', 'string', 'max:70'],
            'complexiteExercice' => ['required'],
            'prixExercice' => ['required', 'string'],
            'fichierExercice' => ['mimes:pdf'],
        ]);

        if ($request->autreMat!=null) {
            $autre=$request->autreMat;
        }else{
            $autre="aucune";
        }

         // Récupérez la taille du fichier en octets
         $tailleDuFichierOctets = Storage::size($chemin_image);

         // Convertissez la taille du fichier en unités plus conviviales (ko, Mo, Go, etc.)
         $tailleDuFichierLisible = $this->formatBytes($tailleDuFichierOctets);

         $devoirs->update([

            'matiere_id' => $request->nomMatiereExercice,
            'autre' =>$autre,
            'description' => $request->descriptionExercice,
            'complexite' => $request->complexiteExercice,
            'filiere' => $request->filiereExercice,
            'type' => $request->typeExercice,
            'fichierdev' => $chemin_image,
            'taille' => $tailleDuFichierLisible,
            'tarif' => $request->prixExercice,
        ]);

        $devoirs->devoirable()->update([
            'source' => $request->sourceExercice,
            'devoir_id' => $devoirs->id,
        ]);
        return Redirect()->route('exercices.index')->with('success',"L'exercice a été modifié avec succès");

    }

}

