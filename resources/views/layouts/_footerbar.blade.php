 <!--========= Footer ==========  -->
 <section id="footer">
     <div class="container">
         <div class="row pt-5">
             <div class="col-lg-3">
                 <div class="footer_logo">
                     <a href=""><img src="/assets/skoodos/assets/img/footer/Logo copy.png" alt=""></a>
                 </div>

                 <div class=" mt-3">
                     <a href="">
                         <h5>Connect with Us</h5>
                     </a>
                     @livewire('footer')
                     <div class="footer_follow">
                         <p>Follow us:</p>
                         <a href="https://www.facebook.com/Skoodos/" class="facebook"><i class="bi bi-facebook"></i></a>
                         <a href="https://www.instagram.com/skoodos/" class="instagram"><i class="bi bi-instagram"></i></a>
                         <a href="https://www.youtube.com/@skoodos561" class="facebook"><i class="bi bi-youtube"></i></a>
                         <a href="https://www.linkedin.com/company/skoodos-bridge/" class="facebook"><i class="bi bi-linkedin"></i></a>
                     </div>
                     {{-- <div class="app-store-links mt-4">
                         <a href=""><img src="/assets/skoodos/assets/img/footer/appsstore.png"
                                 alt=""></a>
                         <a href=""> <img src="/assets/skoodos/assets/img/footer/google_play.png"
                                 alt=""></a>
                     </div> --}}
                     <div class="terms">
                         <a href="{{ route('privacy.policy') }}">
                             <p>Privacy Policy</p>
                         </a>
                         <p>|</p>
                         <a href="{{ route('terms_of_use') }}">
                             <p>Terms of Use</p>
                         </a>
                     </div>

                 </div>
                 <!-- <div class="footer_desc">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptatibus similique
            quia exercitationem cumque placeat eaque temporibus numquam, dolorem quae earum nisi
            eveniet mollitia, quidem fuga laboriosam. Tempore, quo explicabo.</p>
        </div> -->
             </div>
             @if (isset($entrance) && $entrance->count() > 0)

                 <div class="col-lg-3">
                     <a href="">
                         <h5>Entrance Exams</h5>
                     </a>
                     <ul>
                         @foreach ($entrance as $entran)
                             <li>
                                {{-- <a href="{{ route('explore.institute', ["rcategory" => 1, "rstream" => $entran->id, "rexam" => 0, "rstate" => 0, "rcity" => 0, "rarea" => 0,  "rseoslug" =>  \App\Helpers\Helper::SeoUrl(["category" => 1, "stream" => $entran->id, "exam" => 0, "state" => 0, "city" => 0, "area" => 0]), '']) }}">{{ \App\Helpers\Helper::SeoUrl(["category" => 1, "stream" => $entran->id, "exam" => 0, "state" => 0, "city" => 0, "area" => 0]), '' }}</a> --}}
                                <a href="{{ route('explore.institute', ["rcategory" => 1, "rstream" => $entran->id, "rexam" => 0, "rstate" => 0, "rcity" => 0, "rarea" => 0, "rseoslug" => \App\Helpers\Helper::SeoUrl(["category" => 1, "stream" => $entran->id, "exam" => 0, "state" => 0, "city" => 0, "area" => 0]), '']) }}">{{ ucwords(str_replace('-', ' ', \App\Helpers\Helper::SeoUrl(["category" => 1, "stream" => $entran->id, "exam" => 0, "state" => 0, "city" => 0, "area" => 0]))) }}</a>


                            </li>
                         @endforeach

                     </ul>
                 </div>
             @endif

             @if (isset($government) && $government->count() > 0)

                 <div class="col-lg-3">
                     <a href="">
                         <h5>Government Exams</h5>
                     </a>
                     <ul>
                         @foreach ($government as $govrn)
                             <li>
                                <a href="{{ route('explore.institute', ["rcategory" => 2, "rstream" => $govrn->id, "rexam" => 0, "rstate" => 0, "rcity" => 0, "rarea" => 0, "rseoslug" => \App\Helpers\Helper::SeoUrl(["category" => 2, "stream" => $govrn->id, "exam" => 0, "state" => 0, "city" => 0, "area" => 0]), '']) }}">{{ ucwords(str_replace('-', ' ', \App\Helpers\Helper::SeoUrl(["category" => 2, "stream" => $govrn->id, "exam" => 0, "state" => 0, "city" => 0, "area" => 0]))) }}</a>
                            </li>
                         @endforeach
                     </ul>

                 </div>

             @endif

             @if (isset($foreign) && $foreign->count() > 0)
             <div class="col-lg-3">
                 <a href="">
                     <h5>Foreign Language Exams</h5>
                 </a>
                 <ul>
                    @foreach ($foreign as $f )
                    <li>
                    <a href="{{ route('explore.institute', ["rcategory" => 3, "rstream" => $f->id, "rexam" => 0, "rstate" => 0, "rcity" => 0, "rarea" => 0, "rseoslug" => \App\Helpers\Helper::SeoUrl(["category" => 3, "stream" => $f->id, "exam" => 0, "state" => 0, "city" => 0, "area" => 0]), '']) }}">{{ ucwords(str_replace('-', ' ', \App\Helpers\Helper::SeoUrl(["category" => 3, "stream" => $f->id, "exam" => 0, "state" => 0, "city" => 0, "area" => 0]))) }}</a>

                    </li>

                    @endforeach

                 </ul>
             </div>
             @endif
         </div>
     </div>
     <div class="footer_bottom text-center ">
         <p>&copy; Copyright Skoodos Bridge {{ date('Y') }}, A Venture of Spherion Solutions Private Limited</p>
     </div>
 </section>
 <!-- End Footer -->
