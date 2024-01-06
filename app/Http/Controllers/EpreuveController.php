<?php

namespace App\Http\Controllers;

use App\Models\Devoir;
use App\Models\Epreuve;
use App\Models\Matiere;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class EpreuveController extends Controller
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
        return view('DASHBOARD.PAGES.createEpreuve', compact('matieres'));
    }

    public function store(Request $request){
        //dd($request);
        $request->validate([

            'nomMatiereEpreuve' => ['required', 'string'],
            'typeEpreuve' => ['required', 'string', 'max:60'],
            'filiereEpreuve' => ['required', 'string', 'max:60'],
            'autreMat' => ['max:100'],
            'anneEpreuve' => ['required', 'integer'],
            'descriptionEpreuve' => ['required', 'string'],
            'sessionEpreuve' => ['required', 'string'],
            'complexiteEpreuve' => ['required', 'string'],
            'prixEpreuve' => ['required', 'string'],
            'fichierEpreuve' => ['required', 'mimes:pdf'],
        ]);

        //dd($request);
        if ($request->autreMat==null) {
            $autre="Aucune";
        }else{
            $autre=$request->autreMat;
        }
        $chemin_fichier=$request->fichierEpreuve->store('epreuves');

        // Récupérez la taille du fichier en octets
        $tailleDuFichierOctets = Storage::size($chemin_fichier);

        // Convertissez la taille du fichier en unités plus conviviales (ko, Mo, Go, etc.)
        $tailleDuFichierLisible = $this->formatBytes($tailleDuFichierOctets);
        //$tailleDuFichierMo = $this->convertirEnMo($tailleDuFichierOctets);


        //dd($tailleDuFichierMo);
        $devoirs = Devoir::create([

            'matiere_id' => $request->nomMatiereEpreuve,
            'autre' =>$autre,
            'description' => $request->descriptionEpreuve,
            'complexite' => $request->complexiteEpreuve,
            'filiere' => $request->filiereEpreuve,
            'type' => $request->typeEpreuve,
            'fichierdev' => $chemin_fichier,
            'taille' => $tailleDuFichierLisible,
            'tarif' => $request->prixEpreuve,

            //'taile' => $tailleDuFichierLisible,
        ]);
        $epreuves = Epreuve::create([

            'annee' => $request->anneEpreuve,
            'session' => $request->sessionEpreuve,
            'devoir_id' => $devoirs->id,
        ]);
        $devoirs->devoirable()->associate($epreuves); // Associez l'Epreuve au Devoir
        $devoirs->save();// Sauvegardez le Devoir pour enregistrer l'association
        return Redirect()->route('epreuves.index')->with('success',"Vous avez ajouté une nouvelle épreuve avec succès");
        //return back();
    }

    public function index(){
       $epreuves=Epreuve::all();
        return view('DASHBOARD.PAGES.indexEpreuve',compact('epreuves'));
    }

    public function destroy($id){
        try {
            // Récupérer le cours à supprimer
            $epreuves = Epreuve::findOrFail($id);
            //dd($epreuves->);

            // Vérifier si le cours existe
            if (!$epreuves) {
                return back()->with('error', "L'épreuve n'existe pas.");
            }

            // Récupérer le nom du fichier
            $nomFichier = $epreuves->fichierdev;
            // Supprimer le fichier du dossier storage
                 $cheminFichier = 'storage/' . $nomFichier;
            //dd($cheminFichier);

            if (Storage::exists($cheminFichier)) {
                Storage::delete($cheminFichier);
            }

            // Supprimer l'épreuve de la base de données
            $epreuves->delete();

            // Supprimer le devoir assosié de la base de données
            if ($epreuves->devoir) {
                $epreuves->devoir->delete();
            }
           return back()->with('success', "L'épreuve a été supprimé avec succès.");

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

            $epreuves=Epreuve::find($id);
            return view('DASHBOARD.PAGES.editEpreuve', compact('epreuves','matieres'));
    }



    public function update(Request $request,$id)
    {
        $rules=[
            'nomMatiereEpreuve' => ['required', 'string'],
            'typeEpreuve' => ['required', 'string', 'max:60'],
            'filiereEpreuve' => ['required', 'string', 'max:60'],
            'autreMat' => ['max:100'],
            'anneEpreuve' => ['required', 'integer'],
            'descriptionEpreuve' => ['required', 'string'],
            'sessionEpreuve' => ['required', 'string'],
            'complexiteEpreuve' => ['required', 'string'],
            'prixEpreuve' => ['required', 'integer'],
            //'fichierEpreuve' => ['required', 'mimes:pdf'],
        ];
        if ($request->has("fichierEpreuve")) {
            $rules["fichierEpreuve"]=['mimes:pdf'];
        }
        $this->validate($request, $rules);

        $devoirs=Devoir::find($id);
        $ancienCheminImage = $devoirs->fichierdev; //récupération de l'ancien fichier
        if ($request->has("fichierEpreuve")) {
            // Si un nouveau fichier est téléchargé, supprimer l'ancien fichier et enregistrer le nouveau
            Storage::delete($ancienCheminImage);//supprimer l'image
            $chemin_image=$request->fichierEpreuve->store("epreuves");
        }else{
            // Si aucun nouveau fichier n'est téléchargé, conserver l'ancien chemin d'image
            $chemin_image = $ancienCheminImage;
        }
        //dd($chemin_image);
        $request->validate([
            'nomMatiereEpreuve' => ['required', 'string'],
            'typeEpreuve' => ['required', 'string', 'max:60'],
            'filiereEpreuve' => ['required', 'string', 'max:60'],
            'autreMat' => ['max:100'],
            'anneEpreuve' => ['required', 'integer'],
            'descriptionEpreuve' => ['required', 'string'],
            'sessionEpreuve' => ['required', 'string'],
            'complexiteEpreuve' => ['required', 'string'],
            'prixEpreuve' => ['required', 'integer'],
            'fichierEpreuve' => ['mimes:pdf'],
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

                'matiere_id' => $request->nomMatiereEpreuve,
                'autre' =>$autre,
                'description' => $request->descriptionEpreuve,
                'complexite' => $request->complexiteEpreuve,
                'filiere' => $request->filiereEpreuve,
                'type' => $request->typeEpreuve,
                'fichierdev' => $chemin_image,
                'taille' => $tailleDuFichierLisible,
                'tarif' => $request->prixEpreuve,
        ]);
        $devoirs->devoirable()->update([
            'annee' => $request->anneEpreuve,
            'session' => $request->sessionEpreuve,
            'devoir_id' => $devoirs->id,
        ]);
            return Redirect()->route('epreuves.index')->with('success',"L'épreuve a été modifié avec success");

    }


}
