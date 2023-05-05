<?php

namespace App\Http\Controllers;

use App\Models\doc_file;
use App\Models\doc_file_track;
use App\Models\doc_file_trail;
use App\Models\doc_track;
use App\Models\doc_trail;
use App\Models\tblemployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiveController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function received()
    {
        $get = doc_trail::tree()->where('track_number','2023-03-000002');
        //dd($get );

        return view('Documents.Received');
    }

    public function received_Docs()
    {
        $userID = Auth::user()->employee;

        $tres = [];

        //$incomingDocs = doc_file_track::where('active',1)->where('user_id', $userID)->with(['getDocDetails.getDocType', 'getDocDetails.getDocLevel', 'getDocDetails.getDocTypeSubmitted', 'getDocDetails.getDocStatus'])->get();

        $receivedDocs = doc_track::
        with(['getDocDetails.getDocType',
            'getDocDetails.getDocLevel',
            'getDocDetails.getDocTypeSubmitted',
            'getDocDetails.getDocStatus',
            'getDocDetails.getAuthor',
            'getSender_Details'])
            ->where('target_user_id',Auth::user()->employee)
            ->where('for_status',6)
            ->where('active',1)
            ->whereIn('action',[1,0])
            ->orderBy('created_at', 'DESC')
            ->get()
            ->unique('track_number');

        //        ->whereIn('action',[1,0])
        //Remove by Montz

        foreach ($receivedDocs as $dt) {
            $td = [
                "id" => $dt->getDocDetails->id,
                "track_number" => $dt->getDocDetails->track_number,
                "name" => $dt->getDocDetails->name,
                "desc" => $dt->getDocDetails->desc,
                "status" => $dt->getDocStatus->name,
                "class" => $dt->getDocStatus->class,
                "type" => $dt->getDocDetails->getDocType->doc_type,
                "level" => $dt->getDocDetails->getDocLevel->doc_level,
                "level_class" => $dt->getDocDetails->getDocLevel->class,
                "type_submitted" => $dt->getDocDetails->getDocTypeSubmitted->type,
                "created_by" => $dt->created_by,
                "created_at" => $dt->created_at,
                "release_type" => $dt->getDocDetails->trail_release,
                "action" => $dt->action,
                "note" => $dt->note,
                "original_note" => $dt->getDocDetails->note,
                "__from" => $dt->getDocDetails->getAuthor->firstname." ".$dt->getDocDetails->getAuthor->lastname,
                "sender" => $dt->getSender_Details->firstname." ".$dt->getSender_Details->lastname,
            ];
            $tres[count($tres)] = $td;
        }
        echo json_encode($tres);

    }


    public function release_action(Request $request)
    {
        $data = $request->all();

        $getDoc = doc_file::where('track_number',$request->docID)->first();

        $update_sub_trail= [
            'release_date' => now(),
        ];
        doc_trail::where(['track_number' =>  $request->docID,'target_user_id' =>  $getDoc->holder_user_id])->first()->update($update_sub_trail);

        /* Added by Montz */
        $created_by = doc_trail::where('track_number', $request->docID)->first();
        $doc_holder = tblemployee::where('agencyid', Auth::user()->employee)->first();
        $holder_fullname = $doc_holder->firstname.' '.$doc_holder->lastname;
        /* Created Notification for document release */
        createNotification('document_release', $request->docID, 'user', Auth::user()->employee, $created_by->created_by, 'user', 'Your document with a tracking number : ' . $request->docID . ' has been released by '.$holder_fullname.'.');

        /* Added by Montz */

        $get_track = doc_track::where('for_status',6)->where('target_user_id',Auth::user()->employee)->first();

        $update_track= [
            'action' => 1,
            'seen' => 1,
            'last_activity' => false,
        ];
        doc_track::where(['id' =>  $get_track->id])->first()->update($update_track);

        $get_trail = doc_trail::where('track_number',$request->docID)->where('target_user_id',$request->swal_release_to)->where('receive_date',null)->where('release_date',null)->first();
        if($get_trail){
            $add_incoming_track = [
                'track_number' => $request->docID,
                'doc_trail_id' => $get_trail->id,
                'type' => $request->doc_sendAstype,
                'type_id' => $request->doc_sendAs,
                'target_user_id' =>$request->swal_release_to,
                'note' => $request->swal_release_textarea,
                'for_status' => 3,
                'created_by' => Auth::user()->employee,
                'target_type' => null,
                'target_id' => null,
                'last_activity' => true,
            ];
            $track_id = doc_track::create($add_incoming_track)->id;

            /* Added by Montz */
            $target_id_for_notification = doc_track::where('target_user_id', $request->swal_release_to)->first();
            /* Created Notification for document release and send to another user */
            createNotification('document', $request->docID, 'user', Auth::user()->employee, $target_id_for_notification->target_user_id, 'user', 'You have a document to receive with tracking number : '.$request->docID.'.');

            /* Added by Montz */

        }else{
            $add_incoming_track = [
                'track_number' => $request->docID,
                'type' => $request->doc_sendAstype,
                'type_id' => $request->doc_sendAs,
                'target_user_id' =>$getDoc->created_by,
                'note' => $request->swal_release_textarea,
                'for_status' => 3,
                'created_by' => Auth::user()->employee,
                'target_type' => null,
                'target_id' => null,
                'last_activity' => true,
            ];
            $track_id = doc_track::create($add_incoming_track)->id;

            /* Added by Montz */
            $target_id_for_notification = doc_track::where('target_user_id', $request->swal_release_to)->first();

            /* Created Notification for document release and send to another user */
            createNotification('document', $request->docID, 'user', Auth::user()->employee, $target_id_for_notification->target_user_id, 'user', 'You have a document to receive with tracking number : '.$request->docID.'.');

            /* Added by Montz */

            $update_doc_file = [
                'status' => 7,
            ];
            doc_file::where(['track_number' =>  $getDoc->track_number])->first()->update($update_doc_file);
        }

        return json_encode(array(
            "data"=>$data,
            "get_track"=>$get_track,
            "status" => 200,
        ));
    }

    public function load_trail(Request $request){
        $data = $request->all();


        $image_status = '';

        $get_trails = doc_trail::tree()->where('track_number',$request->docID);


        $release_to = sub_trail($get_trails,$request->docID);

        return json_encode(array(
            "data"=>$data,
            "get_trails"=>$get_trails,
            "release_to"=>$release_to,
        ));

    }

    public function add_trail(Request $request){
        $data = $request->all();

        //$trail_holder = doc_file_trail::with('get_sub_trail.get_user')->where('doc_file_id',$request->docID)->where('currently_file_holder',1)->first();


        if($request->has('new_trail')) {

            $holder = doc_track::where('track_number',$request->docID)->where('action',0)->first();
            $trail_holder = doc_trail::where('track_number',$request->docID)->where('target_user_id',Auth::user()->employee)->first();

            foreach($request->new_trail as $key => $user_id){

                    $add_new_trail = [
                        'track_number' =>  $request->docID,
                        'trail_id' =>  $trail_holder->id,
                        'type' =>  'user',
                        'type_id' =>  $user_id,
                        'target_user_id' =>  $user_id,
                        'created_by' =>  Auth::user()->employee,
                        'target_type' => null,
                        'target_id' => null,
                    ];
                    doc_trail::create($add_new_trail);
            }

            }

        return json_encode(array(
            "data"=>$data,
        ));
    }
}


