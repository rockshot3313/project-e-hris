

<!-- BEGIN: Modal Content -->
<div id="set_employee_leave"  data-tw-backdrop="static" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header" style="background-color:rgb(30, 64, 175)">
                <h2 class="font-medium text-base mr-auto text-white">Set Employee Leave</h2> 
               
            
            </div> <!-- END: Modal Header -->
          
    <form action="/update_leave_type" method="POST" id="update_leave_type_Modal">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
    <div style="padding:20px">
        <input type="hidden" id="edit_username" name="edit_username"  value="{{ Auth::user()->employee}}"> 

        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
            <div class="col-span-12 sm:col-span-6"> 
               <label for="modal-form-1" class="form-label">Fullname</label> 
               <input id="fullname" name="fullname" type="text" class="form-control" placeholder="Type Name" autocomplete="off">
           </div>



            <div class="col-span-12 sm:col-span-6"> 
               <label for="modal-form-1" class="form-label">Gender</label> 
               <input id="gender" name="gender" type="text" class="form-control" placeholder="Type Name" autocomplete="off">
           </div>


    
            <div class="col-span-12 sm:col-span-6"> 
               <label for="modal-form-1" class="form-label">Position</label> 
               <input id="position" name="position" type="text" class="form-control" placeholder="Type Name" autocomplete="off">
           </div>

        
            <div class="col-span-12 sm:col-span-6"> 
               <label for="modal-form-1" class="form-label">Designation</label> 
               <input id="designation" name="designation" type="text" class="form-control" placeholder="Type Name" autocomplete="off">
           </div>


           <div class="col-span-12 sm:col-span-6"> 
            <label for="modal-form-4" class="form-label">Leave Type</label> 
            <select id="edit_leave_cat" name="edit_leave_cat" class="form-select">
                <option value="option_select" disabled selected>Select Leave Type</option>
                @foreach($load_leave_type as $item)
                <option value="{{$item->id}}">{{$item->typename}}</option>
                   @endforeach
               </select> 
            </select> 
        </div>


    
            <div class="col-span-12 sm:col-span-6"> 
               <label for="modal-form-1" class="form-label">Leave Credits</label> 
               <input id="edi_typename" name="edi_typename" type="text" class="form-control" placeholder="Type Name" autocomplete="off">
           </div>


        </div>
           <div class="modal-footer"> 
            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
            <button type="button" id="add__leave_type_btn" href="javascript:;" class="btn btn-primary w-20">Save</button> </div>
    </div>
  </form>
    </div>
    </div>
    </div>
    

    
