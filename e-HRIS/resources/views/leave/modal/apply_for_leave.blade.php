
<!-- BEGIN: Modal Content -->
<div id="apply_for_leave_modal"  data-tw-backdrop="static" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header" style="background-color:rgb(30, 64, 175)">
                <h2 class="font-medium text-base mr-auto text-white">Application for Leave</h2> 
               
            
            </div> <!-- END: Modal Header -->
          
            <form>
        
            <!-- BEGIN: Modal Body -->

            <input type="hidden" id="username" name="username"  value="{{ Auth::user()->employee}}"> 

            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12 sm:col-span-6"> 
                   <label for="modal-form-1" class="form-label">Leave Type</label> 
                   <select id="leave_type_name" name="leave_type_name" class="form-select">
                    <option value="option_select" disabled selected>Please Select</option>
                    <option value="Vacation">Forced Leave</option>
                    <option value="Sick">Special Leave</option>
                    <option value="Sick">Sick Leave</option>
                    <option value="Sick">Vacation</option>
                   </select> 
               </div>

                <div class="col-span-12 sm:col-span-6"> 
                   <label for="modal-form-2" class="form-label">Where Leave will be Spent?</label> 
                   <select id="" name="add_category" class="form-select">
                    <option value="option_select" disabled selected>Please Select</option>
                    <option value="Vacation">Abroad</option>
                    <option value="Sick">Within the Philippines</option>
                   </select> 
               </div>


               <div class="col-span-12 sm:col-span-6"> 
                   <label for="modal-form-4" class="form-label">Inclusive Date - From</label> 
                   <input type="date" id="inclusive_from" name="inclusive_from" type="number" class="form-control" > 
               </div>


            <div class="col-span-12 sm:col-span-6"> 
                <label for="modal-form-3" class="form-label">Inclusive Date - To</label> 
                <input type="date" onclick="calculateDays()" id="inclusive_to" name="inclusive_to" type="number" class="form-control" > 
                </select> 
            </div>
        
            <div class="col-span-12 sm:col-span-6"> 
                <label for="modal-form-3" class="form-label">Number of Working Days Applied For</label> 
                <p id="result" name="result" type="number" class="form-control">Days </p>
                </select> 
            </div>

        
            <div class="col-span-12 sm:col-span-6"> 
                <label for="modal-form-3" class="form-label">Commutation</label> 
                <select id="add_leave_category" name="add_leave_category" class="form-select">
                    <option value="option_select" disabled selected>Please Select</option>
                       <option value="Benefits">Requested</option>
                       <option value="Earned">Not Requested</option>
                   </select> 
            </div>


            <div class="col-span-12 sm:col-span-6"> 
                <label for="modal-form-3" class="form-label">Submit To</label> 
                <select id="add_leave_category" name="add_leave_category" class="tom-select w-full">
                 <option value="option_select" disabled selected>Please Select</option>
                 @foreach($load_employee_hr_details as $item)
                 <option value="{{$item->id}}">
                
                    {{$item->firstname}} &nbsp {{Str::limit($item->mi,1,'.')}} &nbsp {{$item->lastname}}</option>
               
                    @endforeach
                </select> 
            </div>


           
            </div> <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            </form>

            <div class="modal-footer"> 
               <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                <button type="button" id="add__leave_type_btn" href="javascript:;" class="btn btn-primary w-20">Apply</button> </div>
           <!-- END: Modal Footer -->
        </div>
    </div>
</div> <!-- END: Modal Content -->

<script>
    function calculateDays(){
        var inclusive_from = document.getElementById("inclusive_from").value;
        var inclusive_to = document.getElementById("inclusive_to").value;

        var result = document.getElementById("result").value;

        result="Tae";

        const dateOne = new Date(inclusive_from);
        const dateTwo = new Date(inclusive_to);

        const time = Math.abs(dateTwo - dateOne);
        const days = Math.ceil(time / (1000 * 60 * 60 * 24));
        
        document.getElementById("result").innerHTML = days;
    }
</script>    
