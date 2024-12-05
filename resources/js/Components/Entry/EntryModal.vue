<script setup>
import { router } from '@inertiajs/vue3'

const props = defineProps({
    show: Boolean,
    projectId: {
        type: [Number, String],
        required: true
    }
})

const emit = defineEmits(['close'])

const startEntry = (type) => {
    if (type === 'register') {
        router.get(route('entry.start.register', { project: props.projectId }));
    } else {
        router.get(route('entry.start', { project: props.projectId }));
    }
}
</script>

<template>
    <div v-if="show" @click="$emit('close')"
        class="fixed top-0 left-0 flex items-center justify-center bg-gray-500 bg-opacity-90 w-full h-full z-10">
        <div class="flex justify-center items-center border border-indigo-500 bg-white w-auto p-1 z-20" @click.stop>
            <div class="container overflow-y-hidden h-auto px-5 py-8 sm:w-[500px]">
                <div class="flex justify-between items-center rounded bg-gray-200 font-bold text-xl pl-5 p-1">
                    <h3>会員登録をしていますか？</h3>
                    <button type="button" @click="$emit('close')"
                        class="rounded-md text-gray-700 hover:bg-gray-800 hover:text-white p-2">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z" />
                        </svg>
                    </button>
                </div>
                <div class="flex w-full mt-10 p-2 justify-center space-x-4">
                    <button @click="startEntry('login')"
                        class="rounded bg-blue-500 hover:bg-blue-400 text-white text-lg font-bold px-8 py-2 w-48 text-center">
                        はい<br />（ログイン）
                    </button>
                    <button @click="startEntry('register')"
                        class="rounded text-white bg-gray-500 hover:bg-gray-400 text-lg font-bold py-2 w-48 text-center">
                        いいえ<br />(会員登録)
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>