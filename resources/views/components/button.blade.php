<button {{ $attributes->merge(['class' => 'bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition-colors duration-200']) }}>
    {{ $slot }}
</button>
