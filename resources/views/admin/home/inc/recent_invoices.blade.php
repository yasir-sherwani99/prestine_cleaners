        <div class="col-12 col-md-6" id="recent-invoices">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Invoices</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right" href="{{ route('admin.invoices.index') }}">View All Invoices</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table id="recent-orders" class="table table-hover table-xl mb-0">
                            <thead>
                                <tr>
                                    <th class="border-top-0">INV #</th>
                                    <th class="border-top-0 px-0">Customer</th>
                                    <th class="border-top-0">Due</th>
                                    <th class="border-top-0">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$recent_invoices->isEmpty())  
                                    @foreach($recent_invoices as $invoice)
                                    <tr>
                                        <td class="text-truncate">
                                            <a href="{{ route('admin.invoices.show', ['id' => $invoice->id]) }}">
                                                {{ $invoice->invoice_no }}
                                            </a>
                                        </td>
                                        <td class="px-0">
                                            <a href="{{ route('admin.invoices.customers', ['id' => $invoice->customer_id]) }}">
                                                {{ \Str::limit($invoice->user->name, 13, ' ..') }}
                                            </a>
                                        </td>
                                            <?php
                                                $dt = \Carbon\Carbon::parse($invoice->due_date);
                                                $due_date = $dt->toFormattedDateString();
                                            ?>
                                        <td>
                                            {{ $due_date }}
                                        </td>
                                        <td>&pound; {{ $invoice->total }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 