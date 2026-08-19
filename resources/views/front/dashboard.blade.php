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
                  data-industries="{{ $project->industry_ids }}">
                 <div class="home_card_img">
                     <a href="{{ route('projectdetail', $project->url) }}">
                     <img class="w-100"
                        src="{{ asset('public/newportfolio/' . ($project->listing_image ? 'listing/' . $project->listing_image : 'banners/' . $project->banner_image)) }}"
                        alt="{{ $project->name }}">
                     </a>
                  </div>
                  <div class="content_card">
                     <div class="content_card_head">
                        <h4 class="title_24 mb-0"><a href="{{ route('projectdetail', $project->url) }}">{{ $project->name }}</a></h4>
                     </div>
                     <p class="mb-0">{!! $project->hero_description !!}</p>
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
    const industrySelectionSummary = document.getElementById('industrySelectionSummary');

    function updateSelectionSummary(selector, summaryElement, allLabel) {
        if (!summaryElement) return;

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

    document.querySelectorAll('.industry-filter').forEach(cb => {
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

    function filterProjects() {
        const selectedIndustries = [...document.querySelectorAll('.industry-filter:checked')]
            .map(el => el.value)
            .filter(val => val !== 'all');

        const allIndustriesChecked = indAll.checked;

        document.querySelectorAll('.home_card').forEach(card => {
            const projectIndustries = card.dataset.industries
                ? card.dataset.industries.split(',').map(id => id.trim()).filter(id => id)
                : [];

            const industryMatch =
                allIndustriesChecked ||
                selectedIndustries.length === 0 ||
                selectedIndustries.some(id => projectIndustries.includes(id));

            card.style.display = industryMatch ? 'block' : 'none';
        });
    }

    document.addEventListener('change', function () {
        filterProjects();
    });

    updateSelectionSummary('.industry-filter', industrySelectionSummary, 'All industries');
    setActiveTab('all');
    filterProjects();
});
</script>
@include('layouts.frontfooter')
