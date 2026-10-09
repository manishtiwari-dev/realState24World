 <section class="gray-bg testimonials" id="testimonials">
                <div class="container">
                    <div class="section-title st-center fl-wrap">
                        <h2>What Our Clients Say</h2>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="testimonials-slider-wrap">
                    <div class="testimonials-slider">
                         @foreach($testimonial as $key => $val)
                        <!--slick-item -->
                        <div class="slick-item">
                            <div class="text-carousel-item fl-wrap">
                                <div class="text-carousel-item-header fl-wrap">
                                    <div class="popup-avatar"><img src="{{ asset('uploads/testimonial/' . $val->image)}}" alt="{{ $val->alt }}"></div>
                                    <div class="review-owner fl-wrap">{{ $val->name }}</div>
                                </div>
                                <div class="text-carousel-content fl-wrap">
                                    <p>{{ $val->subtitle }}.</p>
                                </div>
                            </div>
                        </div>
                      @endforeach
                    </div>
                </div>
            </section>