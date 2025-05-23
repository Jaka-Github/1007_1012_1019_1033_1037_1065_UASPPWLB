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

	  
      <!-- Navigation List -->
      <div class="flex-1 overflow-auto">
        <ul class="pt-2 pb-4 space-y-1 text-sm text-gray-700">
			<!-- Home -->
			<li class="rounded-sm hover:bg-indigo-100">
				<a href="/" class="flex items-center p-2 space-x-3 rounded-md">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current text-indigo-600">
					<path d="M469.666,216.45,271.078,33.749a34,34,0,0,0-47.062.98L41.373,217.373,32,226.745V496H208V328h96V496H480V225.958ZM248.038,56.771c.282,0,.108.061-.013.18C247.9,56.832,247.756,56.771,248.038,56.771ZM448,464H336V328a32,32,0,0,0-32-32H208a32,32,0,0,0-32,32V464H64V240L248.038,57.356c.013-.012.014-.023.024-.035L448,240Z"></path>
				</svg>
				<span>Dashboard</span>
				</a>
			</li>

	
			<!-- Tanggapan -->
			<li class="rounded-sm hover:bg-indigo-100">
				<a href="#" class="flex items-center p-2 space-x-3 rounded-md">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current text-indigo-600">
					<path d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95.1 57.6 130.4L48 480l109.6-10.8C193.5 492.3 223.3 496 256 496c141.4 0 256-93.1 256-208S397.4 32 256 32zm0 336c-70.7 0-128-57.3-128-128s57.3-128 128-128 128 57.3 128 128-57.3 128-128 128z"/>
					<circle cx="256" cy="240" r="32"/>
					<circle cx="192" cy="240" r="32"/>
					<circle cx="320" cy="240" r="32"/>
				</svg>
				<span>Tanggapan</span>
				</a>
			</li>

			<!-- Jadwal Ibadah -->
			<li class="rounded-sm hover:bg-indigo-100">
				<a href="#" class="flex items-center p-2 space-x-3 rounded-md">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current text-indigo-600">
					<path d="M128 0c17.7 0 32 14.3 32 32V64H352V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H512V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z"/>
				</svg>
				<span>Jadwal Ibadah</span>
				</a>
			</li>

			<!-- Lihat Anggota Keluarga -->
			<li class="rounded-sm hover:bg-indigo-100">
				<a href="{{ route('anggota.index') }}" class="flex items-center p-2 space-x-3 rounded-md">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current text-indigo-600">
					<path d="M184 48H328c4.4 0 8 3.6 8 8V96H176V56c0-4.4 3.6-8 8-8zm-56 8V96H64C28.7 96 0 124.7 0 160v96H192 320 512V160c0-35.3-28.7-64-64-64H384V56c0-30.9-25.1-56-56-56H184c-30.9 0-56 25.1-56 56zM512 288H320v32c0 17.7-14.3 32-32 32H224c-17.7 0-32-14.3-32-32V288H0V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V288z"/>
					<circle cx="144" cy="208" r="16"/>
					<circle cx="240" cy="208" r="16"/>
					<circle cx="336" cy="208" r="16"/>
				</svg>
				<span>Anggota Keluarga</span>
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
