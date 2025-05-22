<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sidebar Example</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex">
  <div class="flex flex-col h-full p-3 w-60 bg-white shadow-lg">
    <div class="space-y-3">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold">Dashboard</h2>
        <button class="p-2 hover:bg-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current">
            <rect width="352" height="32" x="80" y="96"></rect>
            <rect width="352" height="32" x="80" y="240"></rect>
            <rect width="352" height="32" x="80" y="384"></rect>
          </svg>
        </button>
      </div>

      <!-- Search -->
      <div class="relative">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <svg fill="currentColor" viewBox="0 0 512 512" class="w-5 h-5 text-gray-400">
            <path d="M479.6,399.716l-81.084-81.084-62.368-25.767A175.014,175.014,0,0,0,368,192c0-97.047-78.953-176-176-176S16,94.953,16,192,94.953,368,192,368a175.034,175.034,0,0,0,101.619-32.377l25.7,62.2L400.4,478.911a56,56,0,1,0,79.2-79.195ZM48,192c0-79.4,64.6-144,144-144s144,64.6,144,144S271.4,336,192,336,48,271.4,48,192ZM456.971,456.284a24.028,24.028,0,0,1-33.942,0l-76.572-76.572-23.894-57.835L380.4,345.771l76.573,76.572A24.028,24.028,0,0,1,456.971,456.284Z"></path>
          </svg>
        </span>
        <input type="search" name="Search" placeholder="Search..." class="w-full py-2 pl-10 text-sm rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
      </div>

      <!-- Navigation List -->
      <div class="flex-1 overflow-auto">
        <ul class="pt-2 pb-4 space-y-1 text-sm text-gray-700">
			<!-- Home -->
			<li class="rounded-sm hover:bg-indigo-100">
				<a href="#" class="flex items-center p-2 space-x-3 rounded-md">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current text-indigo-600">
					<path d="M469.666,216.45,271.078,33.749a34,34,0,0,0-47.062.98L41.373,217.373,32,226.745V496H208V328h96V496H480V225.958ZM248.038,56.771c.282,0,.108.061-.013.18C247.9,56.832,247.756,56.771,248.038,56.771ZM448,464H336V328a32,32,0,0,0-32-32H208a32,32,0,0,0-32,32V464H64V240L248.038,57.356c.013-.012.014-.023.024-.035L448,240Z"></path>
				</svg>
				<span>Home</span>
				</a>
			</li>

			<!-- Search -->
			<li class="rounded-sm hover:bg-indigo-100">
				<a href="#" class="flex items-center p-2 space-x-3 rounded-md">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current text-indigo-600">
					<path d="M479.6,399.716l-81.084-81.084-62.368-25.767A175.014,175.014,0,0,0,368,192c0-97.047-78.953-176-176-176S16,94.953,16,192,94.953,368,192,368a175.034,175.034,0,0,0,101.619-32.377l25.7,62.2L400.4,478.911a56,56,0,1,0,79.2-79.195ZM48,192c0-79.4,64.6-144,144-144s144,64.6,144,144S271.4,336,192,336,48,271.4,48,192ZM456.971,456.284a24.028,24.028,0,0,1-33.942,0l-76.572-76.572-23.894-57.835L380.4,345.771l76.573,76.572A24.028,24.028,0,0,1,456.971,456.284Z"></path>
				</svg>
				<span>Search</span>
				</a>
			</li>

			<!-- Chat -->
			<li class="rounded-sm hover:bg-indigo-100">
				<a href="#" class="flex items-center p-2 space-x-3 rounded-md">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current text-indigo-600">
					<path d="M448.205,392.507c30.519-27.2,47.8-63.455,47.8-101.078,0-39.984-18.718-77.378-52.707-105.3C410.218,158.963,366.432,144,320,144s-90.218,14.963-123.293,42.131C162.718,214.051,144,251.445,144,291.429s18.718,77.378,52.707,105.3c33.075,27.168,76.861,42.13,123.293,42.13,6.187,0,12.412-.273,18.585-.816l10.546,9.141A199.849,199.849,0,0,0,480,496h16V461.943l-4.686-4.685A199.17,199.17,0,0,1,448.205,392.507ZM370.089,423l-21.161-18.341-7.056.865A180.275,180.275,0,0,1,320,406.857c-79.4,0-144-51.781-144-115.428S240.6,176,320,176s144,51.781,144,115.429c0,31.71-15.82,61.314-44.546,83.358l-9.215,7.071,4.252,12.035a231.287,231.287,0,0,0,37.882,67.817A167.839,167.839,0,0,1,370.089,423Z"></path>
					<path d="M60.185,317.476a220.491,220.491,0,0,0,34.808-63.023l4.22-11.975-9.207-7.066C62.918,214.626,48,186.728,48,156.857,48,96.833,109.009,48,184,48c55.168,0,102.767,26.43,124.077,64.3,3.957-.192,7.931-.3,11.923-.3q12.027,0,23.834,1.167c-8.235-21.335-22.537-40.811-42.2-56.961C270.072,30.279,228.3,16,184,16S97.928,30.279,66.364,56.206C33.886,82.885,16,118.63,16,156.857c0,35.8,16.352,70.295,45.091,95.827l.23.225A214.28,214.28,0,0,0,60.185,317.476Z"></path>
				</svg>
				<span>Chat</span>
				</a>
			</li>

			<!-- Profile -->
			<li class="rounded-sm hover:bg-indigo-100">
				<a href="#" class="flex items-center p-2 space-x-3 rounded-md">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current text-indigo-600">
					<path d="M256,256a96,96,0,1,0-96-96A96,96,0,0,0,256,256Zm0,32c-62.182,0-192,31.217-192,93.455V448H448V381.455C448,319.217,318.182,288,256,288Z"></path>
				</svg>
				<span>Profile</span>
				</a>
			</li>
		  	<!-- Logout -->
			<li class="rounded-sm hover:bg-red-100">
			<a href="{{ route('logout') }}" 
				onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
				class="flex items-center p-2 space-x-3 rounded-md text-red-600 hover:text-red-800">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current">
				<path d="M497 273L329 441a24 24 0 01-34-34l79-79H176a24 24 0 010-48h198l-79-79a24 24 0 0134-34l168 168a24 24 0 010 34zM176 352v48a16 16 0 01-16 16H64a32 32 0 01-32-32V144a32 32 0 0132-32h96a16 16 0 0116 16v48" />
				</svg>
				<span>Logout</span>
			</a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
				@csrf
			</form>
			</li>

        </ul>
      </div>
    </div>
  </div>

  <main class="flex-1 p-6">
    <!-- Main content here -->
	 @yield('content')
  </main>

@stack('scripts')

</body>
</html>
