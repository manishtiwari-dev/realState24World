@if($properties->count() > 0)
    @foreach($properties as $property)
        <div class="listing-item has_one_column">
            <article class="geodir-category-listing fl-wrap">
                <div class="geodir-category-img fl-wrap">
                    <a href="#" class="geodir-category-img_item">
                        @if (empty($property->thumbnail))
                            <img src="{{ asset('uploads/property-img.jpg') }}" alt="{{ $property->name }}" />
                        @else
                            <img src="{{ asset('uploads/properties/' . $property->thumbnail . '') }}" alt="{{ $property->name }}" />
                        @endif
                        <div class="overlay"></div>
                    </a>
                    <ul class="list-single-opt_header_cat">
                        <li><a href="#" class="cat-opt blue-bg">Sale</a></li>
                        <li><a href="#" class="cat-opt color-bg">{{ $property->type }}</a></li>
                    </ul>
                    <div class="geodir-category-listing_media-list">
                        <span><i class="fas fa-camera"></i> 8</span>
                    </div>
                </div>
                <div class="geodir-category-content fl-wrap">
                    <h3 class="title-sin_item"><a href="{{ route('property.detail', $property->slug) }}">{{ $property->name }}</a></h3>
                    <div class="property-category-location">
                        <a href="#" class="single-map-item"><i class="fas fa-map-marker-alt"></i> <span> {{ $property->address }}</span></a>
                    </div>
                    <div class="geodir-category-content_price">₹ {{ number_format($property->amount, 2) }}/{{ $property->amount_type ?? '' }}</div>
                    {{-- <p>{{ strip_tags($property->description) }}</p> --}}
                    <p>{{ \Illuminate\Support\Str::words(strip_tags($property->description), 10, '...') }}</p>
                    <div class="geodir-category-content-details">
                        <ul>
                            <li><i class="fal fa-bed"></i><span>{{ $property->bedrooms }}</span> </li>
                            <li><i class="fal fa-bath"></i><span>{{ $property->bathrooms }}</span> </li>
                            <li><i class="fal fa-cube"></i><span>{{ $property->area }} ft</span></li>
                        </ul>
                    </div>
                    <div class="geodir-category-footer fl-wrap">
                        <a href="#" class="gcf-company">
                            @if (!empty($property->dealer))
                                <img src="{{ asset('uploads/dealer/' . $property->dealer->profile_photo . '') }}" alt="{{ $property->dealer->name }}">
                            @else
                                <img src="{{ asset('uploads/blank-img.png') }}" alt="realState24world">
                            @endif
                            @if (!empty($property->dealer))
                                <span> By {{ $property->dealer->name }}</span>
                            @else
                                <span> By realState24world</span>
                            @endif
                        </a>
                        <div class="agent-contact-boc">
                            @if (!empty($property->dealer->id)) 
                            <a href="#" class="btn color-bg small-btn openPopupBtn" data-id="{{ $property->dealer->id }}" data-property="{{ $property->id }}">View Number</a>
                            <a href="#" class="btn color-bg small-btn openPopupBtn" data-id="{{ $property->dealer->id }}" data-property="{{ $property->id }}"><i class="fal fa-phone-alt"></i> Contact</a>
                            @else
                            <a href="#" class="btn color-bg small-btn openPopupBtn" data-id="realState24world" data-property="{{ $property->id }}">View Number</a>
                            <a href="#" class="btn color-bg small-btn openPopupBtn" data-id="realState24world" data-property="{{ $property->id }}"><i class="fal fa-phone-alt"></i> Contact</a>
                            @endif
                        </div>
                    </div>
                </div>
            </article>
        </div>
    @endforeach
@else
    <p>No properties found.</p>
@endif
