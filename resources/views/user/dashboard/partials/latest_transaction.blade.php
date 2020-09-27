
<div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-widgets">
                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                            <a data-toggle="collapse" href="#cardCollpase5" role="button" aria-expanded="false" aria-controls="cardCollpase5"><i class="mdi mdi-minus"></i></a>
                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                        </div>
                        <h4 class="header-title mb-0">Last Five Transactions</h4>

                        <div id="cardCollpase5" class="collapse pt-3 show">
                            <div class="table-responsive">
                                <table class="table table-hover table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Detail</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@if(!empty($latest_five_transaction))
                                    		@foreach($latest_five_transaction as $transaction)
                                    			 <tr>
		                                            <td>{{ $transaction->entry_date }}</td>		                                            
		                                            <td>{{ $transaction->payment_detail }}</td>		
		                                            @if( $transaction->sending_or_receiving == 0)                                            
		                                            	<td>Debit</td>	
		                                            @else	                                            
		                                            	<td>Credit</td>		                                            
		                                            @endif
		                                            <td>&#8377; {{ $transaction->pay_amount }}</td>		                                            
		                                        </tr>
                                    		@endforeach
                                    	@endif
                                    </tbody>
                                </table>
                            </div> <!-- end table responsive-->
                        </div> <!-- collapsed end -->
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->