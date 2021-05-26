<section id="contact" class="contact-section" style="background-image: url(assets/img/contact-image/contact-bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="all-section-title">
                    <h5>get a quote</h5>
                    <h2>book a services</h2>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="contact-form">
                    <h1>Fill All Information Details To Consult With Us To Get Sevices From Us</h1>
                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Name*" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email*" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control" placeholder="Phone*" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" placeholder="Subject*" required restrict="A-Z\a-z\0-9">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="Message*" rows="7" data-form-field="Message" required restrict="A-Z\a-z\0-9"></textarea>
                        </div>
                        <button type="submit" class="btn custom-btn">send messege</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> 
 