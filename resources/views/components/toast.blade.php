
    <div 
         x-data="{ show: true }" 
         x-init="setTimeout(() => show = false, 3000)"
         x-show="show"
         class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg transition transform duration-300"
         x-transition:enter="transform transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         style="display: none;"
    >
        {{ session('success') }}
    </div>
