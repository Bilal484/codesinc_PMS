<x-filament-panels::page>
    <div
        x-data="{
            draggedTask: null,
            draggedFrom: null,
            updateTaskStatus(taskId, newStatus) {
                $wire.updateTaskStatus(taskId, newStatus, 0)
                    .then(() => $wire.$refresh())
            }
        }"
        class="flex gap-4 overflow-x-auto pb-4"
    >
        @foreach ($this->statuses as $statusKey => $statusLabel)
            <div
                class="flex-shrink-0 w-80 bg-gray-50 dark:bg-gray-900 rounded-xl p-3"
                x-on:dragover.prevent
                x-on:drop.prevent="
                    if (draggedTask && draggedFrom !== '{{ $statusKey }}') {
                        updateTaskStatus(draggedTask, '{{ $statusKey }}')
                        draggedTask = null
                        draggedFrom = null
                    }
                "
            >
                <div class="flex items-center justify-between mb-3 px-1">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        {{ $statusLabel }}
                    </h3>
                    <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-gray-600 dark:text-gray-400 bg-gray-200 dark:bg-gray-700 rounded-full">
                        {{ $this->getTasksByStatus($statusKey)->count() }}
                    </span>
                </div>

                <div class="space-y-2 min-h-[200px]">
                    @foreach ($this->getTasksByStatus($statusKey) as $task)
                        <div
                            draggable="true"
                            x-on:dragstart="draggedTask = '{{ $task->id }}'; draggedFrom = '{{ $statusKey }}'"
                            x-on:dragend="draggedTask = null; draggedFrom = null"
                            class="bg-white dark:bg-gray-800 rounded-lg p-3 shadow-sm border border-gray-200 dark:border-gray-700 cursor-grab active:cursor-grabbing hover:shadow-md transition-shadow"
                        >
                            <div class="flex items-start justify-between mb-1">
                                <a href="{{ \Modules\Projects\Filament\Resources\TaskResource::getUrl('edit', ['record' => $task]) }}"
                                   class="text-sm font-medium text-gray-900 dark:text-gray-100 hover:text-primary-600 dark:hover:text-primary-400">
                                    {{ $task->title }}
                                </a>
                            </div>

                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                                {{ $task->project?->name }}
                            </p>

                            @if ($task->labels->isNotEmpty())
                                <div class="flex flex-wrap gap-1 mb-2">
                                    @foreach ($task->labels as $label)
                                        <span class="inline-block px-1.5 py-0.5 text-xs rounded-full text-white" style="background-color: {{ $label->color }}">
                                            {{ $label->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    @php
                                        $priorityColors = [
                                            'low' => 'text-gray-400',
                                            'medium' => 'text-blue-500',
                                            'high' => 'text-orange-500',
                                            'critical' => 'text-red-600',
                                        ];
                                    @endphp
                                    <span class="text-xs {{ $priorityColors[$task->priority] ?? '' }}">
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                </div>

                                @if ($task->assignee)
                                    <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-medium text-white bg-primary-600 rounded-full" title="{{ $task->assignee->name }}">
                                        {{ substr($task->assignee->name, 0, 1) }}
                                    </span>
                                @endif
                            </div>

                            @if ($task->due_date)
                                <div class="mt-2 text-xs {{ $task->due_date->isPast() ? 'text-red-500' : 'text-gray-400' }}">
                                    Due: {{ $task->due_date->format('M d, Y') }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</x-filament-panels::page>
