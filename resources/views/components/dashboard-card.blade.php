<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center">
        <div class="p-3 rounded-full bg-{{ $color }}-100 text-{{ $color }}-600">
            <i class="fas fa-{{ $icon }} text-2xl"></i>
        </div>
        <div class="ml-4">
            <p class="text-sm font-medium text-gray-600">{{ $title }}</p>
            <p class="text-2xl font-semibold text-gray-900">
                {{ isset($prefix) ? $prefix : '' }}{{ $value }}
            </p>
        </div>
    </div>
</div>
