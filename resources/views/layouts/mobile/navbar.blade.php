   <!--  Side Menu Modal -->

   <div class="modal fade side_menu" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
       aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="staticBackdropLabel">
                       What Are You Looking For?
                   </h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <div class="row mt-2">
                       <div class="col-6">
                           <h2>Exam Categories</h2>
                           <ul class="cate_list">
                               @isEntranceExam
                                   <a href="{{ route('exams.entrance-exam') }}">
                                       <li>
                                           <img src="/assets/skoodos/assets/img/homepage/entrance-exam.png"
                                               alt="" />
                                           <p>Entrance Exams</p>
                                       </li>
                                   </a>
                               @endisEntranceExam

                               @isGovernmentExam
                                   <a href="{{ route('exams.government-exam') }}">
                                       <li>
                                           <img src="/assets/skoodos/assets/img/homepage/government-img.png"
                                               alt="" />
                                           <p>Government Exams</p>
                                       </li>
                                   </a>
                               @endisGovernmentExam

                               @isForeignExam
                                   <a href="{{ route('exams.foreign-exam') }}">
                                       <li>
                                           <img src="/assets/skoodos/assets/img/homepage/Foreign-img.png" alt="" />
                                           <p>Foregin Exams</p>
                                       </li>
                                   </a>
                               @endisForeignExam

                           </ul>

                           @student
                               <a href="{{ route('student.profile') }}">
                                   <h2>My Profile</h2>
                               </a>
                           @endstudent
                           <a href="{{ route('blog') }}">
                               <h2>Blog</h2>
                           </a>
                       </div>
                       <div class="col-6">
                           <div>
                               <h2>Connect With Us</h2>
                               <ul class="social">
                                   <a href="">
                                       <li>
                                           <i class="bi bi-facebook"></i>
                                           <p>Facbook</p>
                                       </li>
                                   </a>
                                   <a href="">
                                       <li>
                                           <i class="bi bi-instagram"></i>
                                           <p>Instagram</p>
                                       </li>
                                   </a>
                                   <a href="">
                                       <li>
                                           <i class="bi bi-twitter"></i>
                                           <p>Twitter</p>
                                       </li>
                                   </a>
                                   <a href="">
                                       <li>
                                           <i class="bi bi-linkedin"></i>
                                           <p>Linkedin</p>
                                       </li>
                                   </a>
                                   <a href="">
                                       <li>
                                           <i class="bi bi-youtube"></i>
                                           <p>Youtube</p>
                                       </li>
                                   </a>
                               </ul>
                               <a href="{{ route('explore.explorepage') }}">
                                   <h2>Explore</h2>
                               </a>
                               @student
                                   <a href="{{ route('student.logout') }}"
                                       onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                                       <h2>Log Out</h2>
                                   </a>

                                   <form id="logout-form" action="{{ route('student.logout') }}" method="POST"
                                       class="d-none">
                                       @csrf
                                   </form>
                               @else
                                   @if (Route::has('student.login'))
                                       <a href="{{ route('student.login') }}">
                                           <h2>Login</h2>
                                       </a>
                                   @endif
                               @endstudent
                               {{-- <a href="{{ route('student.logout') }}"
                                   onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                   <h2>Log Out</h2>
                               </a>

                               <form id="logout-form" action="{{ route('student.logout') }}" method="POST"
                                   class="d-none">
                                   @csrf
                               </form> --}}
                           </div>
                       </div>
                   </div>
                   <hr />
                   <div class="m-contact text-center mb-4">
                       <h3>Quick Contact</h3>
                       <a href="tel:+91 837 784 8773"><img src="/assets/skoodos/assets/img/call.png" alt="" />
                           +91 837 784 8773</a>
                       <a href="mailto:hello@skoodosmart.com"><img src="/assets/skoodos/assets/img/mail.png"
                               alt="" />
                           hello@skoodosbridge.com</a>
                   </div>
               </div>
           </div>
       </div>
   </div>
