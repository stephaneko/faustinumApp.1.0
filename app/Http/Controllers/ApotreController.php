<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apotre;

class ApotreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $apotres = apotre::all();

        return view('apotres.index', compact('apotres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('apotres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'apotre_name'=>'required',
        'apotre_surname'=>'required',
        'apotre_paroisse'=>'required',
        'apotre_zone'=>'required',
        'apotre_status'=>'required'
      ]);
      $apotre = new Apotre([
        'apotre_name' => $request->get('apotre_name'),
        'apotre_surname' => $request->get('apotre_surname'),
        'apotre_dateNais' => $request->get('apotre_dateNais'),
        'apotre_paroisse' => $request->get('apotre_paroisse'),
        'apotre_zone' => $request->get('apotre_zone'),
        'apotre_status' => $request->get('apotre_status')
      ]);
     $apotre->save();
      return redirect('/apotres')->with('success', 'Apotres enregistrer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $apotre = apotre::find($id);

        return view('apotres.edit', compact('apotre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
        'apotre_name'=>'required',
        'apotre_surname'=>'required',
        'apotre_paroisse'=>'required',
        'apotre_zone'=>'required',
        'apotre_status'=>'required'
      ]);

       $apotre = apotre::find($id);
       $apotre->apotre_name = $request->get('apotre_name');
       $apotre->apotre_surname = $request->get('apotre_surname');
       $apotre->apotre_dateNais = $request->get('apotre_dateNais');
       $apotre->apotre_paroisse = $request->get('apotre_paroisse');
       $apotre->apotre_zone = $request->get('apotre_zone');
       $apotre->apotre_status = $request->get('apotre_status');
      $apotre->save();

      return redirect('/apotres')->with('success', 'Mise à jour effectuer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $apotre = apotre::find($id);
     $apotre->delete();

     return redirect('/apotres')->with('success', 'suppression reussi');
    }
}
