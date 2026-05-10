@props([
    'id_canvas' => '',
    'modalport',
])
<div>
    <div x-data="{
        openModal: false,
    
    }">

        <button class="block px-4 py-2 text-sm text-white font-bold bg-main-600 rounded-xl  hover:bg-main-800 "
            role="menuitem" x-on:click="handleView"> Detail </button>
        <div x-show="openModal" x-cloak
            class="fixed inset-1 z-40 flex items-center justify-center overflow-auto bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            View CCTV
                        </h3>
                        <button x-on:click="handleClose" type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="" x-ref="modalport" id={{ $modalport }}>
                        <div>
                            <canvas x-ref="modalstreaming" id={{ 'modal-' . $id_canvas }} width="50" height="50"
                                class="p-2 h-[50%]" style="width:100%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function handleView() {
        this.openModal = true
        console.log(this.$refs.modalstreaming.id)
        // console.log($port_canvas)
        console.log(this.$refs.modalport.id)
        var player = new jsmpeg(new WebSocket(`ws://localhost:${this.$refs.modalport.id}`), {
            canvas: document.getElementById(`${this.$refs.modalstreaming.id}`),
            autoplay: true,
            loop: true,
        })
    }

    function handleClose() {
        this.openModal = !this.openModal
        var player = new jsmpeg(new WebSocket(`ws://localhost:${this.$refs.modalport.id}`), {
            canvas: document.getElementById(`${this.$refs.modalstreaming.id}`),
            autoplay: true,
            loop: true,
        })
        player.destroy()
    }
</script>
