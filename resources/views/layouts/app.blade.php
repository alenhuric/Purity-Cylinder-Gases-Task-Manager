<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @fluxAppearance
    @livewireStyles
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800 flex">
    
    @include('components.sidebar')

    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Task Manager</h1>
        @yield('content')
    </div>

    @fluxScripts
    @livewireScripts
</body>
</html>
