<script setup>
import { router } from '@inertiajs/vue3'

const props = defineProps({
    show: Boolean,
    project: {
        type: Object,
        required: true
    },
})

const entry = async () => {
    try {
        router.post(route('entry.'), { data: { project_ids: props.project.id } })
    } catch (error) {
        router.get(route('mypage.entries'))
    }
}

const emit = defineEmits(['close'])
</script>

<template>
    <div v-if="show" @click="$emit('close')"
        class="fixed top-0 left-0 flex items-center justify-center bg-gray-500 bg-opacity-90 w-full h-full z-10">
        <div class="container px-5 py-8 sm:w-[500px]" @click.stop>
            <!-- 案件詳細コンテンツ -->
            <div class="mx-w-2xl mx-auto bg-white rounded-md shadow-sm p-6">
                <div class="mt-4 space-y-4 overflow-y-auto">
                    <section>
                        <h2 class="text-base font-bold text-gray-900">◎ 件名</h2>
                        <p class="mt-1 text-sm text-gray-600">{{ project.title }}</p>
                    </section>    

                    <section>
                        <h2 class="text-base font-bold text-gray-900">◎ 期間</h2>
                        <p class="mt-1 text-sm text-gray-600">{{ project.period }}</p>
                    </section>

                    <section>
                        <h2 class="text-base font-bold text-gray-900">◎ 時間</h2>
                        <p class="mt-1 text-sm text-gray-600">{{ project.working_hours }}</p>
                    </section>

                    <section>
                        <h2 class="text-base font-bold text-gray-900">◎ 場所</h2>
                        <p class="mt-1 text-sm text-gray-600">{{ project.workplace }}</p>
                        <p class="mt-1 text-sm text-gray-600">リモート：{{ project.remote ? 'あり' : 'なし' }}</p>
                    </section>

                    <section>
                        <h2 class="text-base font-bold text-gray-900">◎ 単価</h2>
                        <p class="mt-1 text-sm text-gray-600">{{ project.display_price }}</p>
                    </section>

                    <section>
                        <h2 class="text-base font-bold text-gray-900">◎ 案件概要</h2>
                        <p class="mt-1 text-sm text-gray-600">{{ project.summary }}</p>
                    </section>
                </div>
                <div class="mt-6 flex justify-center space-x-3">
                    <button 
                        type="button"
                        @click="$emit('close')"
                        class="rounded bg-gray-500 hover:bg-gray-400 text-white text-base font-bold px-8 py-2"
                    >
                        戻る
                    </button>
                    <button
                        type="button"
                        @click="entry"
                        class="rounded bg-blue-500 hover:bg-blue-400 text-white text-base font-bold px-8 py-2"
                    >
                        エントリー
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>