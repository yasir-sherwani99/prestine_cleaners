<?php
    $snippets = \App\Snippet::where([['is_active', 1],['location','footer'],['display','site_wide']])->get();
?>
@if (!empty($snippets))
    @foreach($snippets as $snippet)
        {!! $snippet->code !!}
    @endforeach
@endif

<script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
<script>
    $(function() {
        $(document).ready(function() {
   		   $('#subscribe_news').submit(function(e) { // catching form submit
                $(".preloader-wrap").show();
                e.preventDefault(); // preventing usual submit
                var form = $(this).serialize();
                $.ajax({
                	url: "{{ route('subscribe') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: form, 
                    success: function( result ) {
                      	//  window.location.href = '/subscriber/confirmed'; 
                        if(result.response == 'success' || result.response == 'partial_success') {
                        	$(".preloader-wrap").hide();
                            $("#subscriberModal").modal('show');
                      	} else {
                            $(".preloader-wrap").hide();
                        	alert('Error Error Error.')
                      	} 
                    },
                    error: function (request, status, error) {
                        $(".preloader-wrap").hide();
                        json = $.parseJSON(request.responseText);
                        $.each(json.errors, function(key, value){
                            // $('.alert-danger').show();
                            // $('.alert-danger').append('<p>'+value+'</p>');
                            alert('This email has already been registered as subscriber.');
                        });
                    }
                });
            });
  	    });
    });  
    
</script>
@yield('script')