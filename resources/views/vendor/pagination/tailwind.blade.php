@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center space-x-2 mt-4">

    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <span class="px-2 py-2 text-md font-bold text-toychest2 dark:bg-transparent dark:text-toychest2">
        &larr;
    </span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-2 py-2 text-md font-bold text-white dark:bg-transparent dark:text-gray-300 dark:hover:text-toychest2">
        &larr;
    </a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
    <span class="px-2 py-2 text-md font-bold text-white">{{ $element }}</span>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <span class="px-2 py-2 text-md font-bold text-toychest2 bg-transparent dark:bg-blue-600">
        {{ $page }}
    </span>
    @else
    <a href="{{ $url }}" class="px-2 py-2 text-md font-bold text-gray-700 bg-transparent dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
        {{ $page }}
    </a>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-2 py-2 text-md font-bold text-white dark:bg-transparent dark:text-gray-300 dark:hover:text-toychest2">
        &rarr;
    </a>
    @else
    <span class="px-2 py-2 text-md font-bold text-toychest2 dark:bg-transparent dark:text-toychest2">
        &rarr;
    </span>
    @endif
</nav>
@endif