<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        <div style="
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-family: sans-serif;
  font-weight: 600;
  color: #1F2937; /* Gris oscuro elegante */
  font-size: 1.5rem;
">
  <i class="fa-solid fa-calendar-days fa-flip-horizontal fa-2xl" 
     style="
       --fa-primary-color: #74C0FC; 
       --fa-secondary-color: #74C0FC;
       font-size: 2rem;">
  </i>
  <span>Calendar.io</span>
</div>

    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
