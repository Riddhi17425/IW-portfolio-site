@include('layouts.frontheader')
<section class="thank_you">
    <div class="container">
        <div class="text-center col-md-8 m-auto">
            <div class="mb-3">
                 <h2 class="mean_head">THANK YOU FOR CONNECTING.</h2> 
            
              <P clss="my-4">Your goals are now our priority. At intelliwork, we don't just provide solutions; <br> we provide a partnership you can lean on.</P>
            
               <a href="{{url('/')}}" class="head_btn" alt="Start a Project">
                    <span class="btn-text">Back To home</span>
                    <span class="btn-icon"><svg width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.75 11.1346V17.3654C18.75 17.7326 18.6041 18.0848 18.3445 18.3445C18.0848 18.6041 17.7326 18.75 17.3654 18.75H2.13462C1.76739 18.75 1.41521 18.6041 1.15554 18.3445C0.895879 18.0848 0.75 17.7326 0.75 17.3654V2.13462C0.75 1.76739 0.895879 1.41521 1.15554 1.15554C1.41521 0.895879 1.76739 0.75 2.13462 0.75H8.36538" stroke="#0A101C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M13.9039 0.750034H18.7501V5.59619" stroke="#0A101C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M18.7499 0.750034L9.74988 9.75003" stroke="#0A101C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </a>
            </div>
            <div> 
               <img class=" img-fluid" src="{{ asset('public/front/images/thank-you.png') }}" alt="thank you">
            </div>
        </div>
    </div>
</section>
@include('layouts.frontfooter')