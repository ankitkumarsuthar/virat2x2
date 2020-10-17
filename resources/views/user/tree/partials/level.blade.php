 <div class="row">
    <div class="col-12">
        <div class="card" style="width: 500% !important;">
            <div class="card-body" style="">

             {{--  --}}

            <div class="tree">
               @foreach($tree_v as $tree)                
              <ul>
                    <li>
                         <a href="#"> {{ $tree['id'] }}</a>
                    
                     @if(!empty($tree['child']))
                        {!! \App\Http\Controllers\User\TreeViewController::subChilds($tree['child']) !!}
                    @endif
                    
                    </li>
                   
              </ul>
                @endforeach
            </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

