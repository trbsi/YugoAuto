<button type="button" x-bind:class="darkMode ? 'bg-indigo-500' : 'bg-gray-200'"
        x-on:click="darkMode = !darkMode"
        class="mr-2 ml-2 relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        role="switch" aria-checked="false">
    <span class="sr-only">Dark mode toggle</span>
    <span x-bind:class="darkMode ? 'translate-x-5 bg-gray-700' : 'translate-x-0 bg-white'"
          class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full shadow ring-0 transition duration-200 ease-in-out">
        <span
            x-bind:class="darkMode ? 'opacity-0 ease-out duration-100' : 'opacity-100 ease-in duration-200'"
            class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
            aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-400"
             viewBox="0 0 20 20" fill="currentColor">
        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
        </svg>
        </span>
        <span
            x-bind:class="darkMode ?  'opacity-100 ease-in duration-200' : 'opacity-0 ease-out duration-100'"
            class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
            aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white"
             viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd"
              d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
              clip-rule="evenodd"/>
        </svg>
        </span>
    </span>
</button>
