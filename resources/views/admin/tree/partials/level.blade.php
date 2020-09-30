 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

             {{--  --}}

            <div class="tree">
                @foreach($tree_v as $tree)                
              
                    <li>
                         <a href="#"> {{ $tree['self_sponsor_key'] }}</a>
                    <ul> 
                     @if(!empty($tree['child']))
                        {!! \App\Http\Controllers\Admin\TreeViewController::viewsubcat($tree['child']) !!}
                    @endif
                    </ul>
                    </li>
                   
              
                @endforeach
            </div>

            <div class="tree">

                {!!  $ulLI !!}
                <ul>
                    <li>
                        <a href="#">Parent</a>
                        <ul>
                            <li>
                                <a href="#">A</a>
                                <ul>
                                    <li>
                                        <a href="#">Grand Child</a>
                                        <ul>
                                            <li>
                                                <a href="#">Grand Child</a>
                                                <ul>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#">Grand Child</a>
                                                <ul>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Grand Child</a>
                                        <ul>
                                            <li>
                                                <a href="#">Grand Child</a>
                                                <ul>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#">Grand Child</a>
                                                <ul>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">B</a>
                                <ul>
                                    <li>
                                        <a href="#">Grand Child</a>
                                        <ul>
                                            <li>
                                                <a href="#">Grand Child</a>
                                                <ul>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#">Grand Child</a>
                                                <ul>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Grand Child</a>
                                        <ul>
                                            <li>
                                                <a href="#">Grand Child</a>
                                                <ul>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#">Grand Child3</a>
                                                <ul>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                        <ul>
                                                            <li>
                                                                <a href="#">Grand Child</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">Grand Child</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                        <ul>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Grand Child</a>
                                                    </li>
                                                </ul>
                                                    </li>
                                                </ul>

                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

