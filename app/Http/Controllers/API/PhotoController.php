<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth, Validator;
use App\Models\Photo;
use App\Models\User;

class PhotoController extends Controller
{
    


    public function addPhoto(Request $request){

        if( Auth::check() ){

            $validator = Validator::make(
                $request->all(), [
                'Standard' => 'required|mimes:jpg,jpeg,png,bmp'
                ],[
                    'Standard.required' => 'Please upload an image',
                    'Standard.mimes' => 'Only jpeg,png and bmp images are allowed',
                    // 'photos.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'StatusCode' => 422,
                    'Message' => $validator->errors()->first()
                ], 422);
            }

            $user_id = auth()->user()->id;

            if($request->hasFile('Standard')) {
                
                $photo = $request->file('Standard'); 
            
                $path = public_path('uploads/users');
                // foreach($photos as $photo){
                    
                    $filename = time().$photo->getClientOriginalName();
                    $photo->move($path, $filename);

                    //store image file into directory and db
                    $save = new Photo();
                    $save->UserId = $user_id;
                    $save->Standard = asset('uploads/users/'.$filename);
                    $save->Thumbnail = asset('uploads/users/'.$filename);
                    $save->IsPrivatePhoto = ($request->IsPrivatePhoto=="true")?1:0;
                    $save->save();

                // }


                $photos = Photo::where(['UserId'=>$user_id, 'IsPrivatePhoto'=> '0'])->get();
                $privatephotos = Photo::where(['UserId'=>$user_id, 'IsPrivatePhoto'=> '1'])->get();
               
                return response()->json([
                    'StatusCode' => 200,
                    'Message' => 'success',
                    'Photo' => $photos,
                    'PrivatePhoto' => $privatephotos
                ], 200);

            }


        }else{
            return response()->json([
                'StatusCode' => 401,
                'Message' => 'Unauthenticated',
            ], 401);
        }
    }






    public function deletePhoto(Request $request){

        if( Auth::check() ){

            $validator = Validator::make(
                $request->all(), [
                'PhotoIdsToDelete' => 'required'
                ],[
                    'PhotoIdsToDelete.required' => 'Input string was not in a correct format.',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'StatusCode' => 422,
                    'Message' => $validator->errors()->first(),
                    'Photo' => null,
                    'PrivatePhoto' => null
                ], 422);
            }

            $user_id = auth()->user()->id;


        

            $photo = Photo::where(['id'=>$request->PhotoIdsToDelete, 'UserId'=>$user_id])->first();
            
            if( !empty($photo->id) && $photo->delete()){
                $photos = Photo::where(['UserId'=>$user_id, 'IsPrivatePhoto'=> '0'])->get();
                $privatephotos = Photo::where(['UserId'=>$user_id, 'IsPrivatePhoto'=> '1'])->get();

                return response()->json([
                    'StatusCode' => 200,
                    'Message' => 'success',
                    'Photo' => $photos,
                    'PrivatePhoto' => $privatephotos
                ], 200);
            }else{
                $photos = Photo::where(['UserId'=>$user_id, 'IsPrivatePhoto'=> '0'])->get();
                $privatephotos = Photo::where(['UserId'=>$user_id, 'IsPrivatePhoto'=> '1'])->get();

                return response()->json([
                    'StatusCode' => 200,
                    'Message' => 'success',
                    'Photo' => $photos,
                    'PrivatePhoto' => $privatephotos
                ], 200);
            }
            
        }else{
            return response()->json([
                'StatusCode' => 401,
                'Message' => 'Unauthenticated',
            ], 401);
        }
    }





}
