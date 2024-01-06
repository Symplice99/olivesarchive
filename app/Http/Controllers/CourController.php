<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use App\Models\Niveau;
use App\Models\Domaine;
use App\Models\Matiere;
use Illuminate\View\View;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Coroutine;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class CourController extends Controller
{

    // Fonction pour formater la taille en octets en une chaîne lisible
    function formatBytes($bytes, $precision = 2) {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    //convertir la taille du fichier en Mo
    // private function convertirEnMo($tailleLisible)
    // {
    //     // Divisez la taille lisible pour obtenir la taille en mégaoctets
    //     $tailleEnMo = (float) filter_var($tailleLisible, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    //     return round($tailleEnMo / 1024, 2);
    // }

    public function create():View{
        $matieres=Matiere::all();
        $niveaux=Niveau::all();
        $domaines=Domaine::all();
        return view('DASHBOARD.PAGES.createCours', compact('matieres', 'niveaux', 'domaines'));
    }

    public function store(Request $request){
        //dd($request);
        $request->validate([

            'nomCours' => ['required', 'string', 'max:60'],
            'nomMatiereCours' => ['required', 'string', 'max:60'],
            'classeCours' => ['required', 'string', 'max:60'],
            'descriptionCours' => ['required', 'string', 'max:1000'],
            'nomDomaineCours' => ['required', 'string', 'max:60'],
            'nomNiveauCours' => ['required', 'string', 'max:60'],
            'fichierCours' => ['required', 'mimes:pdf'],
        ]);
        //dd($request);
        $chemin_fichier=$request->fichierCours->store('cours');

        // Récupérez la taille du fichier en octets
        $tailleDuFichierOctets = Storage::size($chemin_fichier);

        // Convertissez la taille du fichier en unités plus conviviales (ko, Mo, Go, etc.)
        $tailleDuFichierLisible = $this->formatBytes($tailleDuFichierOctets);
        //$tailleDuFichierMo = $this->convertirEnMo($tailleDuFichierOctets);


        //dd($tailleDuFichierMo);
        $cours = Cour::create([

            'titre' => $request->nomCours,
            'matiere_id' => $request->nomMatiereCours,
            'classe' => $request->classeCours,
            'description' => $request->descriptionCours,
            'domaine_id' => $request->nomDomaineCours,
            'niveau_id' => $request->nomNiveauCours,
            'fichier' => $chemin_fichier,
            'taile' => $tailleDuFichierLisible,
        ]);

        return Redirect()->route('cours.index')->with('success',"Vous avez ajouté un nouvel cours avec success");
    }

    public function index(){
        $cours=Cour::all();
        return view('DASHBOARD.PAGES.indexCours',compact('cours'));
    }

    public function destroy($id)
    {

           // Récupérer le cours à supprimer
            $cours = Cour::findOrFail($id);

            // Vérifier si le cours existe
            if (!$cours) {
                return back()->with('error', 'Le cours n\'existe pas.');
            }
            //dd('oui');

            // Récupérer le nom du fichier
            $nomFichier = $cours->fichier;
            // Supprimer le fichier du dossier storage
                 $cheminFichier = 'storage/' . $nomFichier;
            //dd($cheminFichier);

            if (Storage::exists($cheminFichier)) {
                Storage::delete($cheminFichier);
            }

        try {
            // Suppression de l'élément

            $cours->delete();
            // Autres actions après la suppression réussie, si nécessaire

                return redirect()->route('cours.index')->with('success', 'L\'élément a été supprimé avec succès.');
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


    public function edit($id)
    {
        $matieres=Matiere::all();
        $niveaux=Niveau::all();
        $domaines=Domaine::all();
        $cours=Cour::find($id);
        return view('DASHBOARD.PAGES.editCours', compact('cours','matieres','niveaux','domaines'));
    }

    public function update(Request $request,$id)
    {
        $rules=[
            'nomCours' => ['required', 'string', 'max:60'],
            'nomMatiereCours' => ['required', 'string', 'max:60'],
            'classeCours' => ['required', 'string', 'max:60'],
            'descriptionCours' => ['required', 'string', 'max:255'],
            'nomDomaineCours' => ['required', 'string', 'max:60'],
            'nomNiveauCours' => ['required', 'string', 'max:60'],
            //'fichierCours' => ['required', 'mimes:pdf'],
            // 'nomcours' => ['required', 'string', 'max:30'],
            // 'maxoraire' => ['required', 'string', 'max:3'],
            // 'prix' => ['required', 'integer', 'min:4'],

            // 'catmat' => ['required'],
        ];
        if ($request->has("fichierCours")) {
            $rules["fichierCours"]=['mimes:pdf'];
        }
        $this->validate($request, $rules);

        $cours=Cour::find($id);
        $ancienCheminImage = $cours->fichier; //récupération de l'ancien fichier

        if ($request->has("fichierCours")) {
            Storage::delete($ancienCheminImage);//supprimer l'image
            $chemin_image=$request->fichierCours->store("cours");
        }else{
            // Si aucun nouveau fichier n'est téléchargé, conserver l'ancien chemin d'image
            $chemin_image = $ancienCheminImage;
        }
        $request->validate([
            'nomCours' => ['required', 'string', 'max:60'],
            'nomMatiereCours' => ['required', 'string', 'max:60'],
            'classeCours' => ['required', 'string', 'max:60'],
            'descriptionCours' => ['required', 'string', 'max:1000'],
            'nomDomaineCours' => ['required', 'string', 'max:60'],
            'nomNiveauCours' => ['required', 'string', 'max:60'],
            'fichierCours' => ['mimes:pdf'],
        ]);

         // Récupérez la taille du fichier en octets
         $tailleDuFichierOctets = Storage::size($chemin_image);

         // Convertissez la taille du fichier en unités plus conviviales (ko, Mo, Go, etc.)
         $tailleDuFichierLisible = $this->formatBytes($tailleDuFichierOctets);
        $cours->update([
            'titre' => $request->nomCours,
            'matiere_id' => $request->nomMatiereCours,
            'classe' => $request->classeCours,
            'description' => $request->descriptionCours,
            'domaine_id' => $request->nomDomaineCours,
            'niveau_id' => $request->nomNiveauCours,
            'fichier' => $chemin_image,
            'taile' => $tailleDuFichierLisible,

        ]);
        return Redirect()->route('cours.index')->with('success',"Le cours a été modifié avec succès");

    }


}
