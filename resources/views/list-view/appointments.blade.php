<ul style="list-style-type: none; padding: 0; margin: 0; display: flex; flex-wrap: wrap;">
    @foreach ($list as $i => $data)
        <li style="display: inline-flex; align-items: center; justify-content: center; padding: 10px; border: 1px solid #e2e8f0; margin: 4px; border-radius: 8px;">
            {{ ++$i }}
            <button 
                @click="check($i)" 
                type="button" 
                class="ms-auto w-4 flex -mx-1.5 -my-1.5 text-gray-400 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white" 
                style="background-color: #ffffff; color: #4b5563; border-radius: 8px; padding: 6px; transition: background-color 0.3s, color 0.3s;" 
                aria-label="Check">
                <span class="sr-only">Check</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13"/>
                </svg>
            </button>
        </li>
    @endforeach
</ul>
