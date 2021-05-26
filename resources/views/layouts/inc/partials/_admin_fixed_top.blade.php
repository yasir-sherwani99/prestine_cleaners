<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                      <h3 class="brand-text">Prestine Cleaners</h3>
                    </a>
                </li>
                <li class="nav-item d-none d-md-block float-right"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="mr-1">Hello,
                                <span class="user-name text-bold-700">{{ Auth::guard('admin')->user()->name }}</span>
                            </span>
                            @php
                                $image = Auth::guard('admin')->user()->image;
                            @endphp
                            @if($image == "" || $image == NULL)  
                            <span class="avatar avatar-online">
                                <img src="{{ asset('assets/img/admins/default-avatar.png') }}" alt="Prestine Cleaners avatar"><i></i>
                            </span>
                            @else
                            <span class="avatar avatar-online">
                                <img src="{{ asset('assets/img/admins/'.$image) }}" alt="Prestine Cleaners avatar"><i></i>
                            </span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="{{ route('admin.admins.edit', ['id' => Auth::guard('admin')->user()->id]) }}"><i class="ft-user"></i> My Profile</a>
                            <a class="dropdown-item" href="{{ route('admin.password.index') }}"><i class="ft-message-square"></i> Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-adminn').submit();"><i class="ft-power"></i> Logout</a>
                            <form id="logout-form-adminn" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                            @csrf
                            </form>
                        </div>
                    </li>
                    @php
                        $total_messages = \App\Contact::where('is_read', 0)->count();
                        $messages = \App\Contact::where('is_read', 0)->orderBy('created_at', 'DESC')->skip(0)->take(5)->get(); 
                    @endphp
                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                            <i class="ficon ft-mail"></i>
                            @if($total_messages != 0)
                                <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">{{ $total_messages }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0">
                                    <span class="grey darken-2">Messages</span>
                                </h6>
                                <span class="notification-tag badge badge-default badge-warning float-right m-0">{{ $total_messages }} New</span>
                            </li>

                            <li class="scrollable-container media-list w-100">
                                @if(!$messages->isEmpty())
                                    @foreach($messages as $message)
                                    <a href="{{ route('admin.messages.details', ['id' => $message->id]) }}">
                                        @php 
                              
                                            $message_len = strlen($message->message); 
                                            $message_sub = substr($message->message, 0,50);
                                            if($message_len > 50) {
                                                $message_title = $message_sub . " ...";
                                            } else {
                                                $message_title = $message->message;
                                            }
                                                
                                        @endphp
                                        <div class="media">
                                            <div class="media-body">
                                                <h6 class="media-heading">{{ $message->name }}</h6>
                                                <p class="notification-text font-small-3 text-muted">{{ $message_title }}</p>
                                                <small>
                                                    <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($message->created_at))->diffForHumans() }}</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                @else
                                    <a>
                                        <div class="media">
                                            <div class="media-body">
                                                <p>No Messages found!</p>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            </li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="{{ route('admin.messages.index') }}">Read all messages</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>