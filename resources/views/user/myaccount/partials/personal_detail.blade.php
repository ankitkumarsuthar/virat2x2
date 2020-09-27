<div class="card">
    <div class="card-body">
        <div class="card-widgets">
            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
            <a data-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false" aria-controls="cardCollpase4"><i class="mdi mdi-minus"></i></a>
            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
        </div>
        <h4 class="header-title mb-0">Personal Details</h4>
            <table class="table table-hover table-centered mb-0" style="margin-top:23px;">
                        <tr>
                            <td>Name</td>
                            <td>{{ $user_master->name }}</td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                            <td>{{ $user_master->mobile }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $user_master->email }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{ $user_master->address }}</td>
                        </tr>
                        <tr>
                            <td>Your Level </td>
                            <td>{{ @$user_level_data['current_level'] }}</td>
                        </tr>
                        <tr>
                            <td>Your Sponsor</td>
                            @if(!empty($user_master->sponser))
                                <td>{{ $user_master->sponser->name }}</td>
                            @else
                            <td>Admin</td>
                            @endif
                        </tr>
                </table>        
      
      </div> <!-- end card-body -->
</div> <!-- end card-->