@props([
    'id_canvas' => '',
    'modalport',
])
<div x-data="{
    openModal: false,
    player: null,
    handleView() {
        this.openModal = true
        this.$nextTick(() => {
            this.player = new jsmpeg(new WebSocket(window.streamWsUrl(this.$refs.modalport.id)), {
                canvas: this.$refs.modalstreaming,
                autoplay: true,
                loop: true,
            })
        })
    },
    handleClose() {
        this.openModal = false
        if (this.player) {
            this.player.destroy()
            this.player = null
        }
    }
}">
    <button @click="handleView"
        class="inline-flex items-center justify-center w-full px-4 py-2.5 text-sm font-medium text-white bg-main rounded-xl transition-colors duration-150 hover:bg-main-600 shadow-sm">
        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
        </svg>
        Lihat Streaming
    </button>

    <div x-show="openModal" x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
        @click.self="handleClose">
        <div x-show="openModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative w-full max-w-4xl max-h-full">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Live Streaming CCTV</h3>
                    <button @click="handleClose"
                        class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-colors">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div x-ref="modalport" id="{{ $modalport }}" class="bg-black">
                    <canvas x-ref="modalstreaming" id="{{ 'modal-' . $id_canvas }}"
                        class="w-full" style="height: 70vh; image-rendering:pixelated;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
