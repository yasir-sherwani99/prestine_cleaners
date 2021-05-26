        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-header card-head-inverse bg-white">
                    <h4 class="card-title black">Today Services</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body {{ $today_services->isEmpty() ? 'height-350' : '' }}">
                        @if(!$today_services->isEmpty())
                            @foreach($today_services as $service)
                            <ul class="list-unstyled border-bottom pb-1">
                                <li>{{ $service->user->name }}</li>
                                <?php
                                    $dt = \Carbon\Carbon::parse($service->cleaning_start_date . ' ' . $service->cleaning_start_time);
                                    $cleaning_time = $dt->toDayDateTimeString();
                                ?>
                                <li>{{ $service->user->phone }} | {{ $cleaning_time }}</li>
                                <li><i class="la la-map-marker"></i> {{ $service->cleaning_area_post_code }}</li>
                            </ul>
                            @endforeach
                            <ul class="list-unstyled">
                                <li class="text-center"><a href="{{ route('admin.bookings.calendar') }}">View Schedule</a></li>
                            </ul>
                        @else
                            <ul class="list-unstyled">
                                <li>You have no cleaning service today.</li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>