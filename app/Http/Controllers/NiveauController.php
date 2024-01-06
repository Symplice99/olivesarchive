<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class NiveauController extends Controller
{
    public function create():View{
        return view('DASHBOARD.PAGES.createNiveau');
    }

    public function index(){
        $niveaux=Niveau::all();
        return view('DASHBOARD.PAGES.indexNiveau',compact('niveaux'));
    }

    public function store(Request $request){
        //dd($request);
        $request->validate([

            'nomNiveau' => ['required', 'string', 'max:60'],
        ]);
        //dd($request);

        $niveaux = Niveau::create([

            'nomniv' => $request->nomNiveau,
        ]);

        return Redirect()->route('niveaux.index')->with('success',"Vous avez ajouté un niveau avec succès");
        //return back();
    }


    public function edit($id)
    {
        $niveaux=Niveau::find($id);
        return view('DASHBOARD.PAGES.editNiveau', compact('niveaux'));
    }

    public function update(Request $request,$id)
    {

        $request->validate([

            'nomNiveau' => ['required', 'string', 'max:60'],
        ]);
        //dd($request);
        $niveaux=Niveau::find($id);
        $niveaux->update([

            'nomniv' => $request->nomNiveau,
        ]);

        return Redirect()->route('niveaux.index')->with('success',"Le niveau a été modifié avec succès");

    }

    public function destroy($id)
    {

        try {
            // Suppression de l'élément
            $niveaux=Niveau::findOrFail($id);
            $niveaux->delete();

            // Autres actions après la suppression réussie, si nécessaire

                return redirect()->route('niveaux.index')->with('success', 'L\'élément a été supprimé avec succès.');
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
