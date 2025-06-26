<div class="space-y-4">
    <div>
        <label for="title" class="block text-sm font-medium mb-1">Title</label>
        <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title', $service->title ?? '') }}"
            required
            class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:text-gray-100"
        >
    </div>

    <div>
        <label for="description" class="block text-sm font-medium mb-1">Description</label>
        <textarea
            id="description"
            name="description"
            rows="3"
            class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:text-gray-100"
        >{{ old('description', $service->description ?? '') }}</textarea>
    </div>

    <div>
        <label for="price" class="block text-sm font-medium mb-1">Price ($)</label>
        <input
            type="number"
            step="0.01"
            id="price"
            name="price"
            value="{{ old('price', $service->price ?? '') }}"
            required
            class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:text-gray-100"
        >
    </div>

    <div>
        <label for="duration_minutes" class="block text-sm font-medium mb-1">Duration (minutes)</label>
        <input
            type="number"
            id="duration_minutes"
            name="duration_minutes"
            value="{{ old('duration_minutes', $service->duration_minutes ?? '') }}"
            required
            class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:text-gray-100"
        >
    </div>
</div>
