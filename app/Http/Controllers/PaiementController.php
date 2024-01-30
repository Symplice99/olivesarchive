<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use FedaPay\FedaPay;
use FedaPay\Payment;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PaiementController extends Controller
{
    public function webhook(Request $request)
    {
        $cour_id = $request->input('courID');
        $client_id = $request->input('clientID');
        $epreuve_id = $request->input('epreuveID');
        $transaction_id = $request->input('transaction-id');
        //dd($transaction_id);
        //$cour=Cour::where('id', $id)->get();

        // Obtenir la date et l'heure actuelles du système
        $dateDuSysteme = Carbon::now();

        // Formater la date au format 'Y-m-d H:i:s'
        $annee = $dateDuSysteme->format('Y');
        $mois = $dateDuSysteme->format('m');
        $jour = $dateDuSysteme->format('d');
        $heure = $dateDuSysteme->format('H:i:s');
        if($cour_id){
            dd($cour_id);
        }elseif ($epreuve_id) {
            dd($epreuve_id);
        }else{
            dd("fjkjdjkkjd");
        }
        // $payment = Paiement::create([
        //     'id_paiement' => $transaction_id,
        //     'annee' => $annee,
        //     'mois' => $mois,
        //     'jour' => $jour,
        //     'heure' => $heure,
        //     'cour_id' => $cour_id,
        //     //'client_id' => $client_id,

        //     // 'devoir_id' => 'transaction-id',
        //     // 'correction_id' => 'transaction-id',
        //     // 'amount' => 'prix', // Montant en centimes
        //     // 'currency' => 'XOF', // Devise
        //     // 'description' => 'Achat en ligne',
        //     // 'montant' => 'montant', // le solde total
        //     'callback_url' => 'SITE/LAYOUTS/accueil/contentAccueilCours.blade.php',

        // ]);
        return Redirect()->route('accueils.indexAccueilCours')->with('success'," Opération effectuée avec succès");

    }
}
