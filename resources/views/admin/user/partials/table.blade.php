<div class="row">
    <div class="col-12">
        <div id="form-message">
        </div>
        <div class="card">
            <div class="card-body">

              <div class="row mb-2">
                    <div class="col-sm-4">
                        {{-- <a href="javascript:void(0);" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add Customers</a> --}}
                    </div>
                    <div class="col-sm-8">
                        <div class="text-sm-right">
                            {{-- <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-cog"></i></button>
                            <button type="button" class="btn btn-light mb-2 mr-1">Import</button>
                            <button type="button" class="btn btn-light mb-2">Export</button> --}}
                            <a href="{{ URL::route('admin.user.create') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add Users</a>
                        </div>
                    </div><!-- end col-->
                </div>
                
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Id</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Mobile || Email</th>                            
                            <th>Level</th>                            
                            <th>Wallet</th>                       
                            <th>Action</th> 
                        </tr>
                    </thead>                  
                </table>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>