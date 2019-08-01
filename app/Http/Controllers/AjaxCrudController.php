<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AjaxCrud;

use Validator;

class AjaxCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(AjaxCrud::latest()->get())
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm">Editer</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Supprimer</button>';
                    return $button;
                })
                ->rawColumns(['action'])

                ->make(true);
        }
        return view('ajax_index');

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
            'montant'    =>  'required',
            'objet'     =>  'required',
            'datePaie'     =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        // $recus = $request->file('recus');

        // $new_name = rand() . '.' . $recus->getClientOriginalExtension();

        // $recus->move(public_path('recus'), $new_name);

        $form_data = array(
            'montant'        =>  $request->montant,
            'objet'         =>  $request->objet,
            'datePaie'           =>  $request->datePaie,
        );

        AjaxCrud::create($form_data);

        return response()->json(['success' => 'Paiement enregistrer avec succès.']);
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
            $data = AjaxCrud::findOrFail($id);
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
        // $image_name = $request->hidden_image;
        // $image = $request->file('recus');
        // if ($image != '') {
        $request->validate(
            [
                'montant'    =>  'required',
                'objet'     =>  'required',
                'datePaie'     =>  'required',
            ]
         );
            // $error = Validator::make($request->all(), $rules);
            // if ($error->fails()) {
            //     return response()->json(['errors' => $error->errors()->all()]);
            // }

        //     $image_name = rand() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('recus'), $image_name);
        // } else {
        //     $rules = array(
        //         'montant'    =>  'required',
        //         'objet'     =>  'required'
        //     );

        //     $error = Validator::make($request->all(), $rules);

        //     if ($error->fails()) {
        //         return response()->json(['errors' => $error->errors()->all()]);
        //     }
        // }

        $form_data = array(
            'montant'       =>   $request->montant,
            'objet'        =>   $request->objet,
            'datePaie'           =>  $request->datePaie,
        );
        AjaxCrud::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Paiement modifier']);
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
