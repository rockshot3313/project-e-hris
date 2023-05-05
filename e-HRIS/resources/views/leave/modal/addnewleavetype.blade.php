
<!-- BEGIN: Modal Content -->
<div id="add_newleave_type_modal" data-tw-backdrop="static" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header" style="background-color:rgb(30, 64, 175)">
                <h2 class="font-medium text-base mr-auto text-white">Add New Leave Type</h2> 
               
            
            </div> <!-- END: Modal Header -->
          
            <form method="POST"  enctype="multipart/form-data">
               @csrf
            <!-- BEGIN: Modal Body -->

            <input type="hidden" id="username" name="username"  value="{{ Auth::user()->employee}}"> 

            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12 sm:col-span-6"> 
                   <label for="modal-form-1" class="form-label">Type Name</label> 
                   <input id="add_typename" name="add_typename" type="text" class="form-control" placeholder="Type Name" autocomplete="off"> 
               </div>

                <div class="col-span-12 sm:col-span-6"> 
                   <label for="modal-form-2" class="form-label">Category</label> 
                   <select id="add_category" name="add_category" class="form-select">
                    <option value="option_select" disabled selected>Category</option>
                    <option value="Vacation">Vacation</option>
                    <option value="Sick">Sick</option>

                   </select> 
               </div>

                <div class="col-span-12 sm:col-span-6"> 
                   <label for="modal-form-3" class="form-label">Qualified Gender</label> 
                   <select id="add_qualifygender" name="add_qualifygender" class="form-select">
                    <option value="option_select" disabled selected>Select Gender</option>
                       <option value="All">All</option>
                       <option value="Female">Female</option>
                       <option value="Male">Male</option>
                       <option value="LGBTQ">LGBTQ</option>   
                   </select> 
               </div>


               <div class="col-span-12 sm:col-span-6"> 
                   <label for="modal-form-4" class="form-label">Number of Leave</label> 
                   <input id="add_number_of_leaves" name="add_number_of_leaves" type="number" class="form-control" value="0"> 
               </div>


            <div class="col-span-12 sm:col-span-6"> 
                <label for="modal-form-3" class="form-label">Leave Category</label> 
                <select id="add_leave_cat" name="add_leave_cat" class="form-select">
                 <option value="option_select" disabled selected>Leave Category Type</option>
                    <option value="Benefits">Benefits</option>
                    <option value="Earned">Earned</option>
                    <option value="Force">Force</option>
                </select> 
            </div>

        
                <div class="col-span-12 sm:col-span-6"> 
                    <label for="modal-form-3" class="form-label">Long Name Type</label> 
                   <textarea id="add_long_name" name="add_long_name" rows="4" class="form-control" cols="48" placeholder="Please Input Long Name Type"></textarea>
               </div>


           
            </div> <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            </form>

            <div class="modal-footer"> 
               <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                <button type="button" id="add__leave_type_btn" href="javascript:;" class="btn btn-primary w-20">Save</button> </div>
           <!-- END: Modal Footer -->
        </div>
    </div>
</div> <!-- END: Modal Content -->