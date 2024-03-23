<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Symfony\Contracts\EventDispatcher\Event;

class EvenmentController extends Controller
{
    public function showEvents(){
        $myEvents = Evenement::orderBy('date_diffus','desc')->paginate(1);

        return view('admin.evenment.evenment',compact('myEvents'));
    }

    public function addEvent(Request $request){
        $new_event = new Evenement();
        $new_event->admin_id = 1;
        $new_event->date_diffus = date('Y-m-d');
        $new_event->time_diffus = date('H:i:s');
        $new_event->titre = $request->input('titr');
        $new_event->description = $request->input('descrip');

        // $new_event->image = $request->input('');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('myImg/evenments/',$filename);
            $new_event->image = $filename;
        }


        $new_event->tags = $request->input('tag');
        $new_event->linkTotags = $request->input('lin');
        $new_event->save();

        return redirect('/evenement_est');
    }

    public function searchEvent(Request $request){
        $output = '';
        $theEvent = Evenement::where('titre','Like','%'.$request->search.'%')
                               ->orWhere('description','Like','%'.$request->search.'%')
                               ->orWhere('tags','Like','Like','%'.$request->search.'%')
                               ->first();
        

        $output.='<div class="card mb-3 text-center">
                        
                        <a href="#" class="open-modal" data-bs-toggle="modal" data-bs-target="#delEventModal" data-value="'.$theEvent->id.'"><p class="card-header"><strong>'.$theEvent->titre.'</strong></p></a>
                    
                        <div class="card-body">
                        
                        <p class="card-title"><strong>'.$theEvent->admins->nom.'</strong></p>
                        <p class="card-subtitle text-muted">'.$theEvent->description.'</p>
                        
                        </div>
                        
                        <img src="{{ asset("myImg/evenments/'.$theEvent->image.'"'.') }}" height="200px" width="100%" alt="">
                        <div class="card-body">
                        <p class="card-text"></p>
                        </div>
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item">#'.$theEvent->tags.'</li>
                        </ul>
                        <div class="card-footer text-muted">
                        Difusé le '.$theEvent->date_diffus.' a '.$theEvent->time_diffus.'
                        </div>         
                    
                </div>';

        return response()->json(['data'=>$output]);
    }

    public function deleteEvent($id){
        $theEvent = Evenement::where('id','=',$id)->first();
        $titre = '"'.$theEvent->titre.'"' . ' est bien supprimé';
        $theEvent->delete();
        return redirect('/evenement_est')->with('eventDel',$titre);
    }


}
