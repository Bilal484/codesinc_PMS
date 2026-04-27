<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Running Timer --}}
        @php $running = $this->getRunningEntry(); @endphp

        @if ($running)
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="relative flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                            </span>
                            <h3 class="text-lg font-semibold text-green-800 dark:text-green-200">Timer Running</h3>
                        </div>
                        <p class="text-sm text-green-700 dark:text-green-300">
                            <strong>{{ $running->task->title }}</strong> &mdash; {{ $running->task->project?->name }}
                        </p>
                        <p class="text-xs text-green-600 dark:text-green-400 mt-1">
                            Started: {{ $running->started_at->format('h:i A') }}
                            ({{ $running->started_at->diffForHumans() }})
                        </p>
                    </div>
                    <div
                        x-data="{
                            startTime: {{ $running->started_at->timestamp * 1000 }},
                            elapsed: '',
                            init() {
                                this.updateElapsed()
                                setInterval(() => this.updateElapsed(), 1000)
                            },
                            updateElapsed() {
                                const diff = Math.floor((Date.now() - this.startTime) / 1000)
                                const h = Math.floor(diff / 3600)
                                const m = Math.floor((diff % 3600) / 60)
                                const s = diff % 60
                                this.elapsed = `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`
                            }
                        }"
                        class="text-right"
                    >
                        <span x-text="elapsed" class="text-3xl font-mono font-bold text-green-800 dark:text-green-200"></span>
                    </div>
                </div>
                <div class="mt-4">
                    <x-filament::button color="danger" wire:click="stopTimer" icon="heroicon-o-stop">
                        Stop Timer
                    </x-filament::button>
                </div>
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-4">Start New Timer</h3>
                <form wire:submit.prevent="startTimer" class="space-y-4">
                    {{ $this->form }}
                    <x-filament::button type="submit" icon="heroicon-o-play" color="success">
                        Start Timer
                    </x-filament::button>
                </form>
            </div>
        @endif

        {{-- Recent Time Entries --}}
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6">
            <h3 class="text-lg font-semibold mb-4">Recent Time Entries</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b dark:border-gray-700">
                            <th class="text-left py-2 px-3 font-medium text-gray-600 dark:text-gray-400">Task</th>
                            <th class="text-left py-2 px-3 font-medium text-gray-600 dark:text-gray-400">Project</th>
                            <th class="text-left py-2 px-3 font-medium text-gray-600 dark:text-gray-400">Date</th>
                            <th class="text-right py-2 px-3 font-medium text-gray-600 dark:text-gray-400">Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->getRecentEntries() as $entry)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2 px-3">{{ $entry->task->title }}</td>
                                <td class="py-2 px-3 text-gray-500">{{ $entry->task->project?->name }}</td>
                                <td class="py-2 px-3 text-gray-500">{{ $entry->started_at->format('M d, Y') }}</td>
                                <td class="py-2 px-3 text-right font-mono">
                                    @if ($entry->duration_minutes)
                                        {{ intdiv($entry->duration_minutes, 60) }}h {{ $entry->duration_minutes % 60 }}m
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-gray-400">No recent time entries</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-filament-panels::page>
