        <div class="col-12 col-md-8" id="recent-transactions">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Bookings</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a class="btn btn-sm btn-info box-shadow-2 px-1 round btn-min-width pull-right" href="{{ route('admin.bookings.index') }}">View New Bookings</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table id="recent-orders" class="table table-hover table-xl mb-0">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Status</th>
                                    <th class="border-top-0">Customer</th>
                                    <th class="border-top-0">Area</th>
                                    <th class="border-top-0">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$recent_bookings->isEmpty())  
                                    @foreach($recent_bookings as $booking)
                                    <tr>
                                        <td class="text-truncate">
                                            @if($booking->is_booked == 0)
                                                <i class="la la-dot-circle-o info darken-4 font-medium-1 mr-1"></i>     Pending
                                            @elseif($booking->is_booked == 1)
                                                <i class="la la-dot-circle-o success darken-4 font-medium-1 mr-1"></i>     Booked
                                            @else
                                                <i class="la la-dot-circle-o danger darken-4 font-medium-1 mr-1"></i>     Cancelled
                                            @endif
                                        </td>
                                        <td class="text-truncate">
                                            <span>{{ \Str::limit($booking->user->name, 20, ' ...') }}</span>
                                        </td>
                                        <td>
                                            <i class="la la-map-marker"></i>&nbsp;{{ \Str::limit($booking->cleaning_area_post_code, 15, ' ...') }}
                                        </td>
                                            <?php
                                                $dt = \Carbon\Carbon::parse($booking->cleaning_start_date);
                                                $cleaning_date = $dt->toFormattedDateString();
                                            ?>
                                        <td>
                                            {{ $cleaning_date }}
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No Bookings Found!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>