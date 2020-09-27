 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

             <div class="tree">
                <ul>
                    <li>
                        <a href="#">Parent</a>
                        <ul>
                        {!! $view_ul_li !!} 
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="#">{{ $tree_user->name }}</a>
                        <ul>
                            {{-- LEVEL 1 USER CHILE --}}
                            <li>               
                            {{-- {{ dd($level2) }}                                              --}}
                                <a href="#">{{ $level1[0] }}</a>
                                <ul>
                                    <li>
                                        <a href="#">{{ $level2[0] }}</a>
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
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">{{ $level2[1] }}</a>
                                    </li>
                                </ul>
                            </li>                            
                            <li>
                                <a href="#">{{ $level1[1] }}</a>
                                <ul>
                                    <li>
                                        <a href="#">{{ $level2[2] }}</a>
                                    </li>
                                    <li>
                                        <a href="#">{{ $level2[3] }}</a>
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

