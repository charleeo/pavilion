<?php
namespace App\Services;

use App\Http\Requests\OnboardClientRequest;
use App\Http\Resources\ClientData;
use App\Mail\ProfileUploadReminder;
use App\Models\Client;
use App\Models\LegalCounsel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ClientService{
    public function getAllClients(Request $request)
    {
        $request->validate(['search'=>['nullable',"string","max:225"]]);
        $data =null;
        $error = null;
        $status =false;
        $message = "No data found";

        try{
            $clientData = DB::table("clients");
            if($request->filled("search") && $request->search !=null){
                $search = $request->search;
                $clientData->where("lastname","LIKE","%$search%");
            }

            $clientData->orderByDesc("created_at");

            $clients = ClientData::collection($clientData->get());
            if(count($clients) > 0){
                $data = $clients;
                $status=true;
                $message="data found";
            }
        }catch(Throwable $e){
            Log::error($e->getMessage());
            $error = $e->getMessage();
            $message="There was an error";
        }

        return response()->json([
            "message" => $message,
            "data" => $data,
            "error" => $error,
            "status" => $status
        ]);
    }

    public function getAClient($id)
    {
        $data =null;
        $error = null;
        $status =false;
        $message = "No data found";
        try{
            $client = DB::table("clients")
            ->where('clients.id', "=", $id)
            ->leftJoin("legal_counsels","legal_counsels.id",'clients.primary_legal_counsel')
            ->select("clients.*",'legal_counsels.counsel_name')
            ->first();
          
            if($client){
                $data = $client;
                $status=true;
                $message="data found";
            }
        }catch(Throwable $e){
            Log::error($e->getMessage());
            $error = $e->getMessage();
            $message="There was an error";
        }

        return response()->json([
            "message" => $message,
            "data" => $data,
            "error" => $error,
            "status" => $status
        ]);
    }
   

    public function onboardClient(OnboardClientRequest $request)
    {
        $data =null;
        $error = null;
        $status =false;
        $message = "No data created";
        
        try{
            $client = new Client();
            $client->email = $request->email;
            $client->firstname = $request->firstname;
            $client->lastname = $request->lastname;
            $client->date_of_birth = $request->date_of_birth;
            $client->case_detail = $request->case_detail;
            $client->date_profiled = $request->date_profiled;
            $client->primary_legal_counsel = $request->primary_legal_counsel;
            
            if($request->file("profile_image")){
               $file = $request->file("profile_image");

                $file_name = time().'_'.$file->getClientOriginalName();
                // $file_extension = $file->getClientOriginalExtension();
           
                $file->move(public_path("/profile"),$file_name);
                $client->profile_image = "/profile/$file_name";

            }
            if($client->save()){
                $status=true;
                $message = 'Data created';
                $data = $client;
            }
        }catch(Throwable $e){
            Log::error($e->getMessage());
            $error = $e->getMessage();
            $message="There was an error";
        }

        return response()->json([
            "message" => $message,
            "data" => $data,
            "error" => $error,
            "status" => $status
        ]);
    }

    public function getACounsels()
    {
        $data =null;
        $error = null;
        $status =false;
        $message = "No data found";
        try{
            $legalCounsels = LegalCounsel::all();
            if(count($legalCounsels) > 0){
                $data = $legalCounsels;
                $status=true;
                $message="data found";
            }
        }catch(Throwable $e){
            Log::error($e->getMessage());
            $error = $e->getMessage();
            $message="There was an error";
        }

        return response()->json([
            "message" => $message,
            "data" => $data,
            "error" => $error,
            "status" => $status
        ]);
    }

    public function profileUploadReminder()
    {
        $message="All users have profile images";
        $totalUserWithoutProfileImage =0;
        $clientsWithoutProfile = DB::table("clients")
        ->whereNull("profile_image")->get(['email','lastname','firstname','id']);

        if(count($clientsWithoutProfile) > 0){
            foreach($clientsWithoutProfile as $client){
                $totalUserWithoutProfileImage ++;
               
                $name = $client->firstname . " ". $client->lastname;
                $mailReceipient = $client->email;
                Mail::to($mailReceipient)->send(new ProfileUploadReminder($name));
            }
            $message = $totalUserWithoutProfileImage . " were reminded";
        }

        return $message;
    }
}