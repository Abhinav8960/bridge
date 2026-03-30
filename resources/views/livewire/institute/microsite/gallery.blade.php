<div>
    @if ($desktopResult)

        <div class="tab-pane fade show active" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
            <div class="microsite-gallery">
                <div class="row microsite-gallery-img">
                    @if ($galleryimg->count() > 0)
                        @foreach ($galleryimg as $img)
                            <div class="column">
                                <img src="{{ !empty($img->image) ? Storage::disk('public')->url($img->image) : '../assets/skoodos/assets/img/defaultImages/Gallery-Image.jpg' }}"
                                    style="width:100%;" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
                            </div>
                        @endforeach
                    @endif
                </div>

                <div id="gallery-modal" class="m-gallery-modal">
                    <span class="close cursor" onclick="closeModal()">&times;</span>
                    <div class="modal-content">
                        @php
                            $sliderrcount = 1;
                        @endphp
                        @if ($galleryimg->count() > 0)
                            @foreach ($galleryimg as $img)
                                <div class="mySlides">
                                    <div class="numbertext">{{ $sliderrcount }} / {{ $galleryimg->count() }}</div>
                                    <img src="{{ !empty($img->image) ? Storage::disk('public')->url($img->image) : '../assets/skoodos/assets/img/defaultImages/Gallery-Image.jpg' }}"
                                        style="width:100%">
                                </div>
                                @php $sliderrcount++; @endphp
                            @endforeach
                        @endif
                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>

                        <div class="caption-container">
                            <p id="caption">{{ $img->caption }}</p>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            @php
                                $slidercount = 1;
                            @endphp
                            @if ($galleryimg->count() > 0)
                                @foreach ($galleryimg as $img)
                                    <div class="column">
                                        <img class="demo cursor"
                                            src="{{ !empty($img->image) ? Storage::disk('public')->url($img->image) : '../assets/skoodos/assets/img/defaultImages/Gallery-Image.jpg' }}"
                                            style="width:100%" onclick="currentSlide({{ $slidercount }})"
                                            alt="{{ $img->alt }}">
                                    </div>
                                    @php $slidercount++; @endphp
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($mobileResult)
        <!-- --------------------- Gallery ---------------- -->

        <div class="tab-pane fade show active" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
            <div class="container">

                <div class="microsite-gallery">
                    <div class="row microsite-gallery-img">
                        @if ($galleryimg->count() > 0)
                            @foreach ($galleryimg as $img)
                                <div class="column">
                                    <img src="{{ !empty($img->image) ? Storage::disk('public')->url($img->image) : '../assets/skoodos/assets/img/defaultImages/Gallery-Image.jpg' }}"
                                        style="width:100%" onclick="openModal();currentSlide(1)"
                                        class="hover-shadow cursor">
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div id="gallery-modal" class="m-gallery-modal">
                        <span class="close cursor" onclick="closeModal()">&times;</span>
                        <div class="modal-content">
                            @php
                                $sliderrcount = 1;
                            @endphp
                            @if ($galleryimg->count() > 0)
                                @foreach ($galleryimg as $img)
                                    <div class="mySlides">
                                        <div class="numbertext">{{ $sliderrcount }} / {{ $galleryimg->count() }}</div>
                                        <img src="{{ !empty($img->image) ? Storage::disk('public')->url($img->image) : '../assets/skoodos/assets/img/defaultImages/Gallery-Image.jpg' }}"
                                            style="width:100%">
                                    </div>
                                    @php $sliderrcount++; @endphp
                                @endforeach
                            @endif

                            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)">&#10095;</a>

                            <div class="caption-container">
                                <p id="caption">{{ $img->caption }}</p>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                @php
                                    $slidercount = 1;
                                @endphp
                                @if ($galleryimg->count() > 0)
                                    @foreach ($galleryimg as $img)
                                        <div class="column">
                                            <img class="demo cursor"
                                                src="{{ !empty($img->image) ? Storage::disk('public')->url($img->image) : '../assets/skoodos/assets/img/defaultImages/Gallery-Image.jpg' }}"
                                                style="width:100%" onclick="currentSlide({{ $slidercount }})"
                                                alt="{{ $img->alt }}">
                                        </div>
                                        @php $slidercount++; @endphp
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- --------------------- End Gallery ---------------- -->
    @endif

</div>
<style>
    .microsite-gallery .demo {
        width: 140px !important;
        height: 140px;
        object-fit: cover;
    }
    .microsite-gallery .modal-content{

        width: 40% !important;
    }
</style>
<script>
    function openModal() {
        document.getElementById("gallery-modal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("gallery-modal").style.display = "none";
    }

    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        var captionText = document.getElementById("caption");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        captionText.innerHTML = dots[slideIndex - 1].alt;
    }
</script>
