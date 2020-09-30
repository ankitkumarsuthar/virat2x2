 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

             {{--  --}}

            <div class="tree">
               @foreach($tree_v as $tree)                
              <ul>
                    <li>
                         <a href="#"> {{ $tree['name'] }}</a>
                    
                     @if(!empty($tree['child']))
                        {!! \App\Http\Controllers\Admin\TreeViewController::subChilds($tree['child']) !!}
                    @endif
                    
                    </li>
                   
              </ul>
                @endforeach
            </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

