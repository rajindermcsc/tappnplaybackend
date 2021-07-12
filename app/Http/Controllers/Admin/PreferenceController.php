<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Preference;

class PreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preferences= Preference::all();
        return view('admin.preferences.index',compact('preferences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.preferences.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
          
         $validator = Validator::make($request->all(), [
                'title' => 'required',
                'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
                
            ],[

                'title.required' => ' The Preference name is required.',
              ]);

            $validator->validate();

            $iconname = time().'.'.$request->icon->extension();  
     
            $request->icon->move(public_path('preferences'), $iconname);
  

            $preferences = Preference::create([
                 'title' => $request->input('title'),
                 'icon' => $iconname
                 
             ]);
           
 
             if($preferences !=="") {
                 return redirect()->route('preferences.index')
                 ->with('success' , 'Preferences created successfully');
             }
         
             return back()->withInput()->with('errors', 'Error creating new Preference');





    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $preference=Preference::find($id);
        return view('admin.preferences.show',compact('preference'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $preference=Preference::find($id);
        return view('admin.preferences.edit',compact('preference'));
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
        $validator = Validator::make($request->all(), [
                'title' => 'required',
                'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048',
                
            ],[

                'title.required' => ' The Preference name is required.',
              ]);

            $validator->validate();
            
            if(!is_null($request->icon))
            {

            $iconname = time().'.'.$request->icon->extension();  
     
            $request->icon->move(public_path('preferences'), $iconname);

           $preferences = Preference::find($id);
            
                 $preferences->title=$request->input('title');
                 $preferences->icon=$iconname;
                 $preferences->save();
                            
            } else {

            $preferences = Preference::find($id);
            
                 $preferences->title=$request->input('title');
                 $preferences->save();
           
            }

             if($preferences !=="") {
                 return redirect()->route('preferences.index')
                 ->with('success' , 'Preferences updated successfully');
             }
         
             return back()->withInput()->with('errors', 'Error creating new Preference');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preference $preference)
    {
         $preference->delete();
    
        return redirect()->route('preferences.index')
                        ->with('success','Preferences deleted successfully');
    }
}
