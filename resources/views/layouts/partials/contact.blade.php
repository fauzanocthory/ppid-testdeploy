<!-- Contact Section -->
<section id="contact" class="contact section">
    <!-- Section Title -->
    <div class="container section-title">
        <h2>Contact</h2>
        <div><span>Contact</span> <span class="description-title">Us</span></div>
    </div><!-- End Section Title -->

    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="contact-info">
                    <div class="contact-card">
                        <h3>Contact Information</h3>
                        <p>Feel free to reach out with any questions about the book, speaking engagements, or media
                            inquiries.</p>

                        <div class="contact-details">
                            <div class="contact-item">
                                <i class="bi bi-envelope"></i>
                                <div>
                                    <h4>Email:</h4>
                                    <p>author@example.com</p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <i class="bi bi-telephone"></i>
                                <div>
                                    <h4>Phone:</h4>
                                    <p>+1 (555) 123-4567</p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <i class="bi bi-geo-alt"></i>
                                <div>
                                    <h4>Address:</h4>
                                    <p>123 Book Street, Literary Lane</p>
                                    <p>Wordsmith City, NY 10001</p>
                                </div>
                            </div>
                        </div>

                        <div class="social-links">
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="contact-form-wrapper">
                    <form action="forms/contact.php" method="post" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">Your Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="John Doe"
                                    required="">
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <label for="email">Your Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="john@example.com" required="">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" name="subject" id="subject"
                                placeholder="I loved your book!" required="">
                        </div>
                        <div class="form-group mt-3">
                            <label for="message">Message</label>
                            <textarea class="form-control" name="message" rows="7" placeholder="Your message here..."
                                required=""></textarea>
                        </div>

                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>

                        <div class="text-center">
                            <button type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- /Contact Section -->