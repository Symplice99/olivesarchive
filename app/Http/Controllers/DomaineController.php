<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class DomaineController extends Controller
{
    public function create():View{
        return view('DASHBOARD.PAGES.createDomaine');
    }

    public function index(){
     $domaines=Domaine::all();
     return view('DASHBOARD.PAGES.indexDomaine',compact('domaines'));

    }

    public function store(Request $request){
        //dd($request);
        $request->validate([

            'nomDomaine' => ['required', 'string', 'max:60'],
            'prixDomaine' => ['required', 'integer', 'min:1'],

        ]);
        //dd($request);

        $domaines = Domaine::create([

            'nomdom' => $request->nomDomaine,
            'prix' => $request->prixDomaine,

        ]);

        return Redirect()->route('domaines.index')->with('success', "Vous avez ajouté un nouvel domaine");
       }

       public function destroy($id)
    {

        try {
            // Suppression de l'élément
            $domaines=Domaine::findOrFail($id);
            $domaines->delete();
            // Autres actions après la suppression réussie, si nécessaire

                return redirect()->route('domaines.index')->with('success', 'L\'élément a été supprimé avec succès.');
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
        $domaines=Domaine::find($id);
        return view('DASHBOARD.PAGES.editDomaine', compact('domaines'));
    }

    public function update(Request $request,$id)
    {

        $request->validate([

            'nomDomaine' => ['required', 'string', 'max:60'],
            'prixDomaine' => ['required', 'integer', 'min:1'],
        ]);
        //dd($request);
        $domaines=Domaine::find($id);
        $domaines->update([

            'nomdom' => $request->nomDomaine,
            'prix' => $request->prixDomaine,
        ]);

        return Redirect()->route('domaines.index')->with('success',"Le dom○7ine a été modifié avec succès");

    }


}
