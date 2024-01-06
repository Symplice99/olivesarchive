<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class MatiereController extends Controller
{
    public function create():View{
        return view('DASHBOARD.PAGES.createMatiere');
    }

    public function index(){
        $matieres=Matiere::all();
        //dd($matieres);
        return view('DASHBOARD.PAGES.indexMatiere',compact('matieres'));
    }

    public function store(Request $request){
        //dd($request);
        $request->validate([

            'nomMatiere' => ['required', 'string', 'max:60'],
        ]);
        //dd($request);

        $matieres = Matiere::create([

            'nommat' => $request->nomMatiere,
        ]);

        return Redirect()->route('matieres.index')->with('success',"Vous avez ajouté une nouvelle matière avec succès");
        //return back();
    }



    public function edit($id)
    {
        $matieres=Matiere::find($id);
        return view('DASHBOARD.PAGES.editMatiere', compact('matieres'));
    }

    public function update(Request $request,$id)
    {

           $request->validate([

            'nomMatiere' => ['required', 'string', 'max:60'],
           ]);
           //dd($request);
           $matieres=Matiere::find($id);
           $matieres->update([

            'nommat' => $request->nomMatiere,
           ]);

           return Redirect()->route('matieres.index')->with('success',"La matière a été modifiée avec succès");

    }

    public function destroy($id){

           try {
            // Suppression de l'élément
                $matieres=Matiere::findOrFail($id);
                $matieres->delete();

            // Autres actions après la suppression réussie, si nécessaire

                return redirect()->route('matieres.index')->with('success', 'L\'élément a été supprimé avec succès.');
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
}
