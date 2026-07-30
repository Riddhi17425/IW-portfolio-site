@include('layouts.frontheader')
<!-- section 1 hero -->
<section class="hero">
   <div class="container">
      <div class="row justify-content-between align-items-center">
         <div class="col-12 col-lg-6">
            <div class="portfolio-text">
               <h1 class="title_90"><span class="title-highlight">Ideas That </span> <br/> <span>Gave Impact</span>
               </h1>
            </div>
         </div>
         <div class="col-12 col-lg-6">
            <p class="hero_para mb-0">Our work reflects the partnerships we build purpose-driven, strategic, and results-focused. Intelliworkz collaborates with brands across industries to design and deliver solutions where strategy meets execution, creating meaningful outcomes, long-term value, and measurable business impact.</p>
         </div>
      </div>
   </div>
</section>
<section class="filter">
   <div class="container">
       <!-- Temporary Commented -->
      <div class="filter_top">
         <div class="select-group" role="region" aria-label="Project filters">
            <!--<div class="filter-select-item" style="display:flex; flex-direction:column;">-->
            <!--   <div class="select-pill" tabindex="0" role="button" aria-haspopup="listbox" aria-expanded="false"-->
            <!--      data-name="services" data-value="{{ session('selectedCategory') ?? 'all' }}">-->
            <!--      <span class="select-label">-->
            <!--      @if(session('selectedCategory') && session('selectedCategory') !== 'all')-->
            <!--         {{ \App\Models\Category::find(session('selectedCategory'))?->name ?? 'Services' }}-->
            <!--      @else-->
            <!--         Services-->
            <!--      @endif-->
            <!--      </span>-->
            <!--      <svg class="chev" width="17" height="9" viewBox="0 0 17 9" fill="none" xmlns="http://www.w3.org/2000/svg">-->
            <!--         <path d="M15.75 0.75L8.25 8.25L0.75 0.75" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />-->
            <!--      </svg>-->
            <!--      <ul class="select-options">-->
            <!--         <li>-->
            <!--            <label>-->
            <!--            <input type="checkbox" class="service-filter" value="all">-->
            <!--            All-->
            <!--            </label>-->
            <!--         </li>-->
            <!--         @foreach($categories as $category)-->
            <!--         <li>-->
            <!--            <label>-->
            <!--            <input type="checkbox"-->
            <!--               class="service-filter"-->
            <!--               value="{{ $category->id }}">-->
            <!--               {{ $category->name }} -->
            <!--            </label>-->
            <!--         </li>-->
            <!--         @endforeach-->
            <!--      </ul>-->
            <!--   </div>-->
            <!--   <small id="serviceSelectionSummary" class="text-muted d-block mt-2">Selected: All categories</small>-->
            <!--</div>-->
            <div class="filter-select-item" style="display:flex; flex-direction:column;">
               <div class="select-pill" tabindex="0" role="button" aria-haspopup="listbox" aria-expanded="false"
                  data-name="industries" data-value="{{ session('selectedIndustry') ?? 'all' }}">
                  <span class="select-label">
                  @if(session('selectedIndustry') && session('selectedIndustry') !== 'all')
                     {{ \App\Models\Industry::find(session('selectedIndustry'))?->title ?? 'Industries' }}
                  @else
                     Industries
                  @endif
                  </span>
                  <svg class="chev" width="17" height="9" viewBox="0 0 17 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M15.75 0.75L8.25 8.25L0.75 0.75" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <ul class="select-options">
                     <li>
                        <label>
                        <input type="checkbox" class="industry-filter" value="all">
                        All
                        </label>
                     </li>
                     @foreach($industries as $industry)
                     <li>
                        <label>
                        <input type="checkbox"
                           class="industry-filter"
                           value="{{ $industry->id }}">
                           {{ $industry->title }}
                        </label>
                     </li>
                     @endforeach
                  </ul>
               </div>
               <small id="industrySelectionSummary" class="text-muted d-block mt-2">Selected: All industries</small>
            </div>
         </div>
         <!--<ul class="nav custom-tabs" id="projectTabList" role="tablist" style="display:none;">-->
         <!--   <li class="nav-item">-->
         <!--      <button type="button" class="nav-link active project-tab-btn" data-tabing="all">All</button>-->
         <!--   </li>-->
         <!--   @foreach($tabings as $tabing)-->
         <!--   <li class="nav-item project-tab-item" data-category="{{ $tabing->category_id }}" style="display:none;">-->
         <!--      <button type="button" class="nav-link project-tab-btn" data-tabing="{{ $tabing->id }}">{{ $tabing->name }}</button>-->
         <!--   </li>-->
         <!--   @endforeach-->
         <!--</ul>-->
      </div>
      <div class="filter_top">
         <div class="tab-content">
            <h3 class="title_30 mb-3" id="projectSectionTitle" style="color:var(--333-grey);">All Projects</h3>
            <div class="home_card_main">
               @foreach($projects as $project)
               <div class="home_card" 
                  data-categories="{{ $project->category_id ?? '' }}"
                  data-industry="{{ $project->industry_id ?? 'none' }}"
                  data-tabings="{{ $project->tabing_id ?? '' }}">
                     <div class="home_card_img">
                        <a href="{{ route('projectdetail', $project->url) }}">
                        <img class="w-100" src="{{ asset('public/product_images/' . $project->image) }}" alt="flexibel">
                        </a>
                        <!-- Temporary Commented -->
                        <!--<div class="btn_card">-->
                        <!--   {{ $project->industry?->title ?? 'No Industry' }}-->
                        <!--</div>-->
                     </div>
                     <div class="content_card">
                        <div class="content_card_head">
                           <h4 class="title_24 mb-0"><a href="{{ route('projectdetail', $project->url) }}">{{ $project->name }}</a></h4>
                          <!--@if($project->category_id == 1 || $project->category_id == 2)-->
                          <!--<a class="card_btn" href="{{ asset('public/product_images/' . $project->image) }}" download>-->
                          <!--     <span>Download</span>-->
                          <!--       <span><svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                          <!--       <path d="M5.63953 0.5V12.7791M5.63953 12.7791L10.7791 7.63953M5.63953 12.7791L0.5 7.63953" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>-->
                          <!--       </svg>-->
                          <!--       </span>-->
                          <!-- </a> -->
                          <!-- @endif-->
                            {{-- <div class="innter_hero_bot_rt d-block">
                              <div class="child">
                                 <p class="icon mb-0">
                                    <a href="https://www.linkedin.com/company/elegant-cosmed-private-limited&quot;" target="_blank">
                                       <!-- LinkedIn Icon SVG -->
                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                          <path d="M22.2234 0H1.77187C0.792187 0 0 0.773438 0 1.72969V22.2656C0 23.2219 0.792187 24 1.77187 24H22.2234C23.2031 24 24 23.2219 24 22.2703V1.72969C24 0.773438 23.2031 0 22.2234 0ZM7.12031 20.4516H3.55781V8.99531H7.12031V20.4516ZM5.33906 7.43437C4.19531 7.43437 3.27187 6.51094 3.27187 5.37187C3.27187 4.23281 4.19531 3.30937 5.33906 3.30937C6.47812 3.30937 7.40156 4.23281 7.40156 5.37187C7.40156 6.50625 6.47812 7.43437 5.33906 7.43437ZM20.4516 20.4516H16.8937V14.8828C16.8937 13.5562 16.8703 11.8453 15.0422 11.8453C13.1906 11.8453 12.9094 13.2937 12.9094 14.7891V20.4516H9.35625V8.99531H12.7687V10.5609H12.8156C13.2891 9.66094 14.4516 8.70937 16.1813 8.70937C19.7859 8.70937 20.4516 11.0812 20.4516 14.1656V20.4516V20.4516Z" fill="#666666"></path>
                                       </svg>
                                    </a>
                                    <a href="https://www.instagram.com/vitashine_dermascience/" target="_blank">
                                       <!-- Instagram Icon SVG -->
                                       <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M15.9705 11.9999C15.9705 14.1927 14.1927 15.9705 11.9999 15.9705C9.8071 15.9705 8.0293 14.1927 8.0293 11.9999C8.0293 9.8071 9.8071 8.0293 11.9999 8.0293C14.1927 8.0293 15.9705 9.8071 15.9705 11.9999Z" fill="black"></path>
                                          <path d="M18.7059 0H5.29412C2.37477 0 0 2.37477 0 5.29412V18.7059C0 21.6252 2.37477 24 5.29412 24H18.7059C21.6252 24 24 21.6252 24 18.7059V5.29412C24 2.37477 21.6252 0 18.7059 0ZM12 18.6176C8.35099 18.6176 5.38235 15.649 5.38235 12C5.38235 8.35099 8.35099 5.38235 12 5.38235C15.649 5.38235 18.6176 8.35099 18.6176 12C18.6176 15.649 15.649 18.6176 12 18.6176ZM19.5882 5.73529C18.8572 5.73529 18.2647 5.14281 18.2647 4.41176C18.2647 3.68072 18.8572 3.08824 19.5882 3.08824C20.3193 3.08824 20.9118 3.68072 20.9118 4.41176C20.9118 5.14281 20.3193 5.73529 19.5882 5.73529Z" fill="black"></path>
                                       </svg>
                                    </a>
                                    <a href="tel:+91 9099099245">
                                       <!-- Phone Icon SVG -->
                                       <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <g clip-path="url(#clip0_1_1166)">
                                             <path d="M12.003 0H11.997C5.3805 0 0 5.382 0 12C0 14.625 0.846 17.058 2.2845 19.0335L0.789 23.4915L5.4015 22.017C7.299 23.274 9.5625 24 12.003 24C18.6195 24 24 18.6165 24 12C24 5.3835 18.6195 0 12.003 0ZM18.9855 16.9455C18.696 17.763 17.547 18.441 16.6305 18.639C16.0035 18.7725 15.1845 18.879 12.4275 17.736C8.901 16.275 6.63 12.6915 6.453 12.459C6.2835 12.2265 5.028 10.5615 5.028 8.8395C5.028 7.1175 5.9025 6.279 6.255 5.919C6.5445 5.6235 7.023 5.4885 7.482 5.4885C7.6305 5.4885 7.764 5.496 7.884 5.502C8.2365 5.517 8.4135 5.538 8.646 6.0945C8.9355 6.792 9.6405 8.514 9.7245 8.691C9.81 8.868 9.8955 9.108 9.7755 9.3405C9.663 9.5805 9.564 9.687 9.387 9.891C9.21 10.095 9.042 10.251 8.865 10.47C8.703 10.6605 8.52 10.8645 8.724 11.217C8.928 11.562 9.633 12.7125 10.671 13.6365C12.0105 14.829 13.0965 15.21 13.485 15.372C13.7745 15.492 14.1195 15.4635 14.331 15.2385C14.5995 14.949 14.931 14.469 15.2685 13.9965C15.5085 13.6575 15.8115 13.6155 16.1295 13.7355C16.4535 13.848 18.168 14.6955 18.5205 14.871C18.873 15.048 19.1055 15.132 19.191 15.2805C19.275 15.429 19.275 16.1265 18.9855 16.9455Z" fill="#666666"></path>
                                          </g>
                                          <defs>
                                             <clipPath id="clip0_1_1166">
                                                <rect width="24" height="24" fill="white"></rect>
                                             </clipPath>
                                          </defs>
                                       </svg>
                                    </a>
                                    <a href="https://www.facebook.com/vitashinedermascience" target="_blank">
                                       <!-- Facebook Icon SVG -->
                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                          <g clip-path="url(#clip0_1_1170)">
                                             <path d="M24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 17.9895 4.3882 22.954 10.125 23.8542V15.4687H7.07812V12H10.125V9.35625C10.125 6.34875 11.9166 4.6875 14.6576 4.6875C15.9701 4.6875 17.3437 4.92187 17.3437 4.92187V7.875H15.8306C14.34 7.875 13.875 8.80008 13.875 9.75V12H17.2031L16.6711 15.4687H13.875V23.8542C19.6118 22.954 24 17.9895 24 12Z" fill="#666666"></path>
                                          </g>
                                          <defs>
                                             <clipPath id="clip0_1_1170">
                                                <rect width="24" height="24" fill="white"></rect>
                                             </clipPath>
                                          </defs>
                                       </svg>
                                    </a>
                                 </p>
                              </div>
                           </div> --}}
                        </div>
                        <p class="mb-0">{!! $project->description !!}</p>
                     </div>
                  </div>
                  @endforeach
               </div>
         </div>
      </div>
   </div>
</section>
<script>
   document.addEventListener('DOMContentLoaded', function () {
           const projectTabList = document.getElementById('projectTabList');
           const projectTabItems = document.querySelectorAll('.project-tab-item');
           const projectTabButtons = document.querySelectorAll('.project-tab-btn');
           const projectSectionTitle = document.getElementById('projectSectionTitle');
        const serviceSelectionSummary = document.getElementById('serviceSelectionSummary');
        const industrySelectionSummary = document.getElementById('industrySelectionSummary');

        function updateSelectionSummary(selector, summaryElement, allLabel) {
           if (!summaryElement) {
              return;
           }

           const selectedLabels = [...document.querySelectorAll(selector + ':checked')]
              .filter(input => input.value !== 'all')
              .map(input => input.parentElement.textContent.trim())
              .filter(Boolean);

           summaryElement.textContent = selectedLabels.length
              ? 'Selected: ' + selectedLabels.join(', ')
              : 'Selected: ' + allLabel;
        }

           function setActiveTab(tabingId) {
              projectTabButtons.forEach(button => {
                 button.classList.toggle('active', button.dataset.tabing === tabingId);
              });

              const activeButton = document.querySelector('.project-tab-btn.active');
              if (projectSectionTitle) {
                 projectSectionTitle.textContent = activeButton ? activeButton.textContent.trim() + ' Projects' : 'All Projects';
              }
           }

           function getActiveTabingId() {
              const activeButton = document.querySelector('.project-tab-btn.active');
              return activeButton ? activeButton.dataset.tabing : 'all';
           }

           function updateDynamicTabs() {
              const selectedServices = [...document.querySelectorAll('.service-filter:checked')]
                 .map(el => el.value)
                 .filter(val => val !== 'all');

              if (!projectTabList) {
                 return;
              }

              if (selectedServices.length === 0) {
                 projectTabList.style.display = 'none';
                 setActiveTab('all');
                 return;
              }

              let visibleTabCount = 0;
              projectTabItems.forEach(item => {
                 const shouldShow = selectedServices.includes(item.dataset.category);
                 item.style.display = shouldShow ? '' : 'none';
                 if (shouldShow) {
                    visibleTabCount += 1;
                 }
              });

              projectTabList.style.display = visibleTabCount > 0 ? 'flex' : 'none';

              const activeTabButton = document.querySelector('.project-tab-btn.active');
              if (activeTabButton && activeTabButton.dataset.tabing !== 'all') {
                 const parentItem = activeTabButton.closest('.project-tab-item');
                 if (parentItem && parentItem.style.display === 'none') {
                    setActiveTab('all');
                 }
              }
           }
   
       // Toggle dropdown
       function toggleDropdown(pill) {
           const isOpen = pill.getAttribute('aria-expanded') === 'true';
           document.querySelectorAll('.select-pill').forEach(p => {
               p.setAttribute('aria-expanded', 'false');
               p.querySelector('.select-options').hidden = true;
               p.querySelector('.chev').style.transform = 'rotate(0deg)';
           });
           if (!isOpen) {
               pill.setAttribute('aria-expanded', 'true');
               pill.querySelector('.select-options').hidden = false;
               pill.querySelector('.chev').style.transform = 'rotate(180deg)';
           }
       }
   
       document.querySelectorAll('.select-pill').forEach(pill => {
           pill.addEventListener('click', function (e) {
               if (e.target.tagName === 'INPUT' || e.target.tagName === 'LABEL') return;
               toggleDropdown(pill);
           });
       });
   
       document.querySelectorAll('.service-filter, .industry-filter').forEach(cb => {
           cb.addEventListener('click', e => e.stopPropagation());
           const label = cb.closest('label');
           if (label) label.addEventListener('click', e => e.stopPropagation());
       });
   
       document.addEventListener('click', function (e) {
           if (!e.target.closest('.select-pill')) {
               document.querySelectorAll('.select-pill').forEach(p => {
                   p.setAttribute('aria-expanded', 'false');
                   p.querySelector('.select-options').hidden = true;
                   p.querySelector('.chev').style.transform = 'rotate(0deg)';
               });
           }
       });
   
       // ================== CHECKBOX MASTER LOGIC ======================
   
       // SERVICES
       const svcAll = document.querySelector('.service-filter[value="all"]');
       const svcOthers = document.querySelectorAll('.service-filter:not([value="all"])');
   
       svcAll.addEventListener('change', () => {
           svcOthers.forEach(cb => cb.checked = svcAll.checked);
            updateSelectionSummary('.service-filter', serviceSelectionSummary, 'All categories');
       });
   
       svcOthers.forEach(cb => {
           cb.addEventListener('change', () => {
               const allChecked = [...svcOthers].every(x => x.checked);
               svcAll.checked = allChecked;
               updateSelectionSummary('.service-filter', serviceSelectionSummary, 'All categories');
           });
       });
   
       // INDUSTRIES
       const indAll = document.querySelector('.industry-filter[value="all"]');
       const indOthers = document.querySelectorAll('.industry-filter:not([value="all"])');
   
       indAll.addEventListener('change', () => {
           indOthers.forEach(cb => cb.checked = indAll.checked);
            updateSelectionSummary('.industry-filter', industrySelectionSummary, 'All industries');
       });
   
       indOthers.forEach(cb => {
           cb.addEventListener('change', () => {
               const allChecked = [...indOthers].every(x => x.checked);
               indAll.checked = allChecked;
               updateSelectionSummary('.industry-filter', industrySelectionSummary, 'All industries');
           });
       });
   
       // ================== FILTER NO CHANGE ======================
       function filterProjects() {
           const selectedServices = [...document.querySelectorAll('.service-filter:checked')]
               .map(el => el.value)
               .filter(val => val !== 'all');
   
           const selectedIndustries = [...document.querySelectorAll('.industry-filter:checked')]
               .map(el => el.value)
               .filter(val => val !== 'all');
   
           const allServicesChecked = svcAll.checked;
           const allIndustriesChecked = indAll.checked;
            const activeTabing = getActiveTabingId();
   
           document.querySelectorAll('.home_card').forEach(card => {
               const projectCategories = card.dataset.categories 
                   ? card.dataset.categories.split(',').map(id => id.trim()).filter(id => id) 
                   : [];
   
               const projectIndustry = card.dataset.industry || '';
               const projectTabings = card.dataset.tabings
                  ? card.dataset.tabings.split(',').map(id => id.trim()).filter(id => id)
                  : [];
   
               const serviceMatch =
                   allServicesChecked ||
                   selectedServices.length === 0 ||
                   projectCategories.some(cat => selectedServices.includes(cat));
   
               const industryMatch =
                   allIndustriesChecked ||
                   selectedIndustries.length === 0 ||
                   selectedIndustries.includes(projectIndustry);

                  const tabingMatch =
                     activeTabing === 'all' ||
                     projectTabings.includes(activeTabing);
   
                  card.style.display = (serviceMatch && industryMatch && tabingMatch) ? 'block' : 'none';
           });
       }

            projectTabButtons.forEach(button => {
               button.addEventListener('click', function () {
                  setActiveTab(this.dataset.tabing);
                  filterProjects();
               });
            });
   
            document.addEventListener('change', function () {
               updateDynamicTabs();
               filterProjects();
            });

               updateSelectionSummary('.service-filter', serviceSelectionSummary, 'All categories');
               updateSelectionSummary('.industry-filter', industrySelectionSummary, 'All industries');
            updateDynamicTabs();
            setActiveTab('all');
       filterProjects();
   });
</script>
@include('layouts.frontfooter')