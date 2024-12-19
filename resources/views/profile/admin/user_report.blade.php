@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <title>User Reports</title>
</head>

<body class="h-full" style="background-color: #eae8e0">
  <x-header />
  <nav class="bg-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <x-admin-sub-navbar />
    </div>
  </nav>
  <main class="pb-8 max-lg:pt-4">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mt-6">
      <div class="bg-white p-6 rounded-lg shadow">
        <div class="sm:flex sm:items-center">
          <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold leading-6 text-gray-900 py-4">User Reports</h1>
          </div>

        </div>

        <!-- Search Bar -->
        <div class="mt-4 mb-6">
          <div class="relative">
            <input type="text" id="searchInput" 
              class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
              placeholder="Search reports">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
              </svg>
            </div>
          </div>
        </div>

        <!-- Sorting and Pagination -->
        <form method="GET" action="{{ route('profile.admin.view_user_report') }}" class="mb-4 flex justify-between items-center">
          <div>
            <label for="perPage" class="mr-2">Records per page:</label>
            <select name="perPage" id="perPage" onchange="this.form.submit()">
              <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
              <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
              <option value="30" {{ request('perPage') == 30 ? 'selected' : '' }}>30</option>
              <option value="all" {{ request('perPage') == 'all' ? 'selected' : '' }}>All</option>
            </select>
          </div>
          <div>
            <label for="sortBy" class="mr-2">Sort by:</label>
            <select name="sortBy" id="sortBy" onchange="this.form.submit()">
              <option value="user_id" {{ request('sortBy') == 'user_id' ? 'selected' : '' }}>User ID</option>
              <option value="username" {{ request('sortBy') == 'username' ? 'selected' : '' }}>Username</option>
              <option value="location_name" {{ request('sortBy') == 'location_name' ? 'selected' : '' }}>Location</option>
              <option value="subdistrict" {{ request('sortBy') == 'subdistrict' ? 'selected' : '' }}>Subdistrict</option>
              <option value="description" {{ request('sortBy') == 'description' ? 'selected' : '' }}>Description</option>
              <option value="created_at" {{ request('sortBy') == 'created_at' ? 'selected' : '' }}>Date</option>
            </select>
            <select name="sortOrder" id="sortOrder" onchange="this.form.submit()">
              <option value="asc" {{ request('sortOrder') == 'asc' ? 'selected' : '' }}>Ascending</option>
              <option value="desc" {{ request('sortOrder') == 'desc' ? 'selected' : '' }}>Descending</option>
            </select>
          </div>
        </form>

        <!-- Table -->
        @if ($reports->isEmpty())
          <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-4l-4 4z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No reports yet</h3>
            <p class="mt-1 text-sm text-gray-500">Waiting for users to submit their reports.</p>
          </div>
        @else
        <div class="overflow-x-auto mt-6 w-full">
          <table class="w-full border-collapse">
            <thead>
              <tr>
                <th class="text-left text-neutral-900 px-3 py-3 bg-neutral-100 rounded-l-lg border border-gray-300">User ID</th>
                <th class="text-left text-neutral-900 px-3 py-3 bg-neutral-100 border border-gray-300">Username</th>
                <th class="text-left text-neutral-900 px-3 py-3 bg-neutral-100 border border-gray-300">Location</th>
                <th class="text-left text-neutral-900 px-3 py-3 bg-neutral-100 border border-gray-300">Subdistrict</th>
                <th class="text-left text-neutral-900 px-3 py-3 bg-neutral-100 border border-gray-300">Description</th>
                <th class="text-left text-neutral-900 px-3 py-3 bg-neutral-100 rounded-r-lg border border-gray-300">Date</th>
              </tr>
            </thead>
            <tbody class="text-neutral-900">
              @foreach($reports as $report)
              <tr class="border-b border-gray-200">
                <td class="px-3 py-3 border border-gray-200">{{ $report->user_id }}</td>
                <td class="px-3 py-3 border border-gray-200">{{ $report->user->username }}</td>
                <td class="px-3 py-3 border border-gray-200">{{ $report->floodLocations->name }}</td>
                <td class="px-3 py-3 border border-gray-200">{{ $report->subdistrict }}</td>
                <td class="px-3 py-3 border border-gray-200">{{ $report->description }}</td>
                <td class="px-3 py-3 border border-gray-200">{{ \Carbon\Carbon::parse($report->created_at)->format('M d, Y H:i') }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @endif
        <!-- Pagination -->
        <div class="mt-4 flex justify-between items-center">
          @if ($reports instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div>
              Showing {{ $reports->firstItem() }} to {{ $reports->lastItem() }} of {{ $reports->total() }} results
            </div>
            <div>
              {{ $reports->appends(['perPage' => request('perPage'), 'sortBy' => request('sortBy'), 'sortOrder' => request('sortOrder')])->links('pagination::simple-tailwind') }}
            </div>
            {{-- <div>
              {{ $users->appends(['perPage' => request('perPage'), 'sortBy' => request('sortBy'), 'sortOrder' => request('sortOrder')])->onEachSide(1)->links('pagination::simple-tailwind') }}
            </div> --}}
            <div>
              <form method="GET" action="{{ route('profile.admin.view_user_report') }}">
                <label for="page" class="mr-2">Go to page:</label>
                <input type="number" name="page" id="page" min="1" max="{{ $reports->lastPage() }}"
                  value="{{ $reports->currentPage() }}" class="border rounded px-2 py-1">
                <input type="hidden" name="perPage" value="{{ request('perPage') }}">
                <input type="hidden" name="sortBy" value="{{ request('sortBy') }}">
                <input type="hidden" name="sortOrder" value="{{ request('sortOrder') }}">
                <button type="submit" class="ml-2 bg-blue-600 text-white px-2 py-1 rounded-md hover:bg-blue-700">Go</button>
              </form>
            </div>
          @endif
        </div>
      </div>
    </div>
  </main>

  <script>
    // Simple search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
      let filter = this.value.toLowerCase();
      let rows = document.querySelectorAll('tbody tr');

      rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
      });
    });
  </script>
</body>

</html>
