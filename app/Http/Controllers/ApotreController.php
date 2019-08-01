<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apotre;

use Validator;

class ApotreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Apotre::latest()->get())
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm">Editer</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Supprimer</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('apotre_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
        'apotre_name'=>'required',
        'apotre_surname'=>'required',
        'apotre_paroisse'=>'required',
        'apotre_zone'=>'required',
        'apotre_status'=>'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'apotre_name'        =>  $request->apotre_name,
            'apotre_surname'         =>  $request->apotre_surname,
            'apotre_dateNais'           =>  $request->apotre_dateNais,
            'apotre_paroisse'        =>  $request->apotre_paroisse,
            'apotre_zone'         =>  $request->apotre_zone,
            'apotre_status'           =>  $request->apotre_status,
        );

        AjaxCrud::create($form_data);

        return response()->json(['success' => 'Apôtre enregistrer avec succès.']);
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
        if (request()->ajax()) {
            $data = Apotre::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $request->validate([
        'apotre_name'=>'required',
        'apotre_surname'=>'required',
        'apotre_paroisse'=>'required',
        'apotre_zone'=>'required',
        'apotre_status'=>'required'
      ]);

        $form_data = array(
            'apotre_name'       =>   $request->apotre_name,
            'apotre_surname'        =>   $request->apotre_surname,
            'apotre_dateNais'           =>  $request->apotre_dateNais,
            'apotre_paroisse'       =>   $request->apotre_paroisse,
            'apotre_zone'        =>   $request->apotre_zone,
            'apotre_status'           =>  $request->apotre_status,
        );
        AjaxCrud::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => ' modifier reussi']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AjaxCrud::findOrFail($id);
        $data->delete();
    }
}
