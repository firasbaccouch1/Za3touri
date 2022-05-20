<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\feedbacksDataTable;
use App\Http\Controllers\Controller;
use App\Models\Users\Feedback;
use Illuminate\Http\Request;

class FeedBacksController extends Controller
{
  public function __construct()
  {
      
      $this->middleware(['adminpermission:guest'])->only('index');
      $this->middleware(['adminpermission:update'])->only('active');
      $this->middleware(['adminpermission:delete'])->only('delete');
  }
    public function index(feedbacksDataTable $datatable){
        return $datatable->render('admin/pages/feedback/Feedback');
    }
    public function delete($id){
        $feedback =  Feedback::findOrFail($id);
        $feedback->delete();
        return redirect()->back()->with(notify_messages('Deleted Successfuly','success'));
    }
    public function active($id){
        $feedback =  Feedback::findOrFail($id);
        if($feedback->status == 1){
          $feedback->update([
            'status' => 0,
          ]);
          return redirect()->back()->with(notify_messages('Feedback unactive Successfully','success'));
        }
        else{
            $feedback->update([
                'status' => 1,
              ]);  
              return redirect()->back()->with(notify_messages('Feedback active Successfully','success')); 
        }
      }
}
