@extends('layouts.app')

@section('content')
    <div class="slideshow-container mb-4">

        <div class="mySlides">
            <img src="https://wallpapercave.com/wp/wp2797466.jpg" style="width:100%">
        </div>

        <div class="mySlides">
            <img src="https://wallpaper-mania.com/wp-content/uploads/2018/09/High_resolution_wallpaper_background_ID_77700222915.jpg"
                style="width:100%">
        </div>

        <div class="mySlides">
            <img src="https://www.supercars.net/blog/wp-content/uploads/2020/09/wallpaperflare.com_wallpaper-1-1.jpg"
                style="width:100%">
        </div>
        <div style="text-align:center" class="dot-container">
            <span class="dot" onclick="currentSlide(0)"></span>
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
        </div>
    </div>
    <br>
    @if (count($discounted_vehicles))
        <div class="akcija-container mt-2 p-4 d-flex flex-column align-items-center">
            <h2 style="font-weight: bold; color: white;">Akcijska ponuda</h4>
                <div class="d-flex justify-content-center flex-wrap gap-4 mt-3">
                    @foreach ($discounted_vehicles as $vehicle)
                        <ul class="carousel-piece">
                            <x-vehicle-card-small :vehicle="$vehicle"></x-vehicle-card-small>
                        </ul>
                    @endforeach
                </div>

        </div>
    @endif
    <div class="container mt-4">
        <div class="row p-4 gx-5 flex-row-reverse">
            <div class="col-lg-6 mb-4">
                <h2 style="font-weight: bold; color:#8a1820;">Najnovije u ponudi</h4>
                    <div class="d-flex flex-column justify-content-between gap-3 align-items-center">
                        @foreach ($latest as $vehicle)
                            <x-vehicle-card-wide :vehicle="$vehicle"></x-vehicle-card-wide>
                        @endforeach
                    </div>
            </div>
            <div class="col-lg-6 mb-4">
                <h2 style="font-weight: bold; color:#8a1820;">Naša lokacija</h4>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2052.4905700785116!2d18.3168698618783!3d43.84299663868699!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4758ca8c9a8e0a5b%3A0x8d64a55011bf4213!2sEUROCENTAR%20D.O.O.!5e0!3m2!1sen!2sba!4v1673920043317!5m2!1sen!2sba"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

    <style>
        .slideshow-container {
            width: 100%;
            position: relative;
            margin: auto;
            overflow: hidden;
        }

        /* Hide the images by default */
        .mySlides {
            display: none;
            animation-name: fade;
            animation-duration: 1.5s;
        }

        /* The dots/bullets/indicators */
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active,
        .dot:hover {
            background-color: #8a1820;
        }

        .dot-container {
            position: absolute;
            top: 90%;
            left: 50%;
            transform: translateX(-50%);
        }

        @keyframes fade {
            from {
                opacity: .75
            }

            to {
                opacity: 1
            }
        }

        .akcija-container {
            background-color: #444;
            width: 100%;
        }

        .carousel-piece {
            margin-bottom: 0;
            padding-left: 0;
        }
    </style>

    <script>
        let slideIndex = 0;
        showSlides(slideIndex++);
        let myInterval = setInterval(() => {
            showSlides(slideIndex++);
        }, 5000);

        function currentSlide(n) {
            clearInterval(myInterval);
            showSlides(n++);
            slideIndex = n;
            myInterval = setInterval(() => {
                showSlides(slideIndex++);
            }, 5000);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n >= slides.length) {
                n = 0;
                slideIndex = 1;
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[n].style.display = "block";
            dots[n].className += " active";
        }
    </script>
@endsection
