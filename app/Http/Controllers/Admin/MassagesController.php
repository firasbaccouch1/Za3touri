<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MassagesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Users\Message;
use Illuminate\Http\Request;

class MassagesController extends Controller
{
  public function __construct()
  {
      
   
      $this->middleware(['adminpermission:delete'])->only('delete');
  }
    public function index(MassagesDataTable $datatable){
        return $datatable->render('admin/pages/massages/Massages');
    }
    public function delete($id){
      $message =  Message::where('id',$id)->first();
      if($message){
        $message->delete();
        return redirect()->back()->with(notify_messages('Deleted Successfuly','success'));
          }
        return redirect()->back()->with(notify_messages('Message not found','error'));
    }
}
