<section class="joinsubscribe ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="single-subscribe">
                    <div class="all-section-title">
                        <h5>subscribe</h5>
                        <h2>Join our subscription and get instant update about offers and discount.</h2>
                    </div>                    
                </div>
            </div>
            <div class="col-lg-5">
                <div class="single-subscribe2">
                    <form id="subscribe_news">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Enter your email address" required>
                            <button type="submit" class="btn subscribe-btn">go</button>
                        </div>
                    </form>
                    <p>Please read our <a href="{{ route('terms_conditions') }}" class="text-white"><u>terms and condition</u></a> before subscribing</p>
                </div>
            </div>
        </div>
    </div>
</section>