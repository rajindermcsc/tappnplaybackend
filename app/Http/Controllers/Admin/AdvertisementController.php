<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['adds'] = Advertisement::all();
        return view( 'admin.adds.index' , $data );
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.adds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'image' => 'required',
            'description'  => 'required',
            'link' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->route('admin.adds.create')->withInput()->withErrors($validator);
        }else{
               
            $postdata = $request->input();
            $insertdata = [
                'title'=> $postdata['title'],
                'image' => $postdata['image'],
                'description'  => $postdata['description'],
                'link' => $postdata['link']
            ];

            if ($request->hasFile('image')){
                $image = $request->file('image');
                $name = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('adds'), $name);
                $insertdata['image'] = $name;
            }
            
            $users = Advertisement::create($insertdata);
             return redirect()->route('admin.adds.create')->with('success',"Insert successfully");
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $data['user'] = Advertisement::find($id);
        return view ( 'admin.adds.edit', $data );
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

        $adds = Advertisement::find($id);
        $rules = [
            'title' => 'required',
            'image' => 'required',
            'description'  => 'required',
            'link' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->route('admin.adds.edit')->withInput()->withErrors($validator);
        }else{
               
            $postdata = $request->input();
            $updatedata = [
                'title'=> $postdata['title'],
                'image' => $postdata['image'],
                'description'  => $postdata['description'],
                'link' => $postdata['link']
            ];

            if ($request->hasFile('image')){
                $image = $request->file('image');
                $name = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('adds'), $name);
                $updatedata['image'] = $name;
            }
            
            $adds->update($updatedata);
             return redirect()->route('admin.adds.edit')->with('success',"updated successfully");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adds = Advertisement::find($id);
        
       if ( !empty($adds->id) ) {
            $adds->delete();
           return redirect()->route('admin.users')->with('success', "Record deleted successfully");
        } 
        else{
            return redirect()->route('admin.users')->with('error' , "Record not deleted");
        }
    }
}
