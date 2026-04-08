@if($activePlayers->isNotEmpty())
<div class="bg-gray-900 border border-gray-800 rounded-2xl p-4">
    <div class="flex items-center gap-2 mb-3">
        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">
            {{ $activePlayers->count() }} {{ $activePlayers->count() === 1 ? 'Player' : 'Players' }} Live
        </span>
    </div>
    <div class="flex gap-2 overflow-x-auto pb-1 sm:flex-wrap sm:pb-0">
        @foreach($activePlayers as $p)
            @php
                $isMe = $p->player_id === $playerId;
                $progressPct = $quiz->questions->count() > 0
                    ? round(($p->current_index / $quiz->questions->count()) * 100)
                    : 0;
            @endphp
            <div class="flex items-center gap-2 bg-gray-800 rounded-xl px-3 py-2 text-sm {{ $isMe ? 'ring-1 ring-violet-500' : '' }}">
                <span class="text-lg leading-none">{{ $p->player_emoji }}</span>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-semibold text-white leading-tight">{{ $p->player_name }}</span>
                        @if($isMe)
                            <span class="text-[10px] text-violet-400 font-bold">(you)</span>
                        @endif
                    </div>
                    @if($p->player_short_id)
                        <span class="text-[10px] text-white font-mono tracking-widest">#{{ $p->player_short_id }}</span>
                    @endif
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <div class="w-16 bg-gray-700 rounded-full h-1 overflow-hidden">
                            <div class="bg-violet-500 h-1 rounded-full" style="width: {{ $progressPct }}%"></div>
                        </div>
                        <span class="text-[10px] text-gray-500 font-mono">{{ $p->score }}pts</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif
