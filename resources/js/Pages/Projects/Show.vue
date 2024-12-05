<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref } from 'vue'  // refをインポート
import AppLayout from '@/Layouts/AppLayout.vue'
import EntryModal from '@/Components/Entry/EntryModal.vue'

defineProps({
    project: {
        type: Object,
        required: true
    }
})

// モーダルの状態を初期化
const showEntryModal = ref(false)
</script>

<template>
    <Head :title="project.title" />
    <AppLayout>
        <template #main>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <!-- パンくずリスト -->
                <div class="mb-6">
                    <nav class="text-gray-500 text-sm">
                        <Link href="/" class="hover:text-gray-700">ホーム</Link>
                        <span class="mx-2">/</span>
                        <span class="text-gray-900">案件詳細</span>
                    </nav>
                </div>

                <!-- 案件詳細コンテンツ -->
                <div class="max-w-2xl mx-auto bg-white rounded-md shadow-sm p-6">
                    <div class="mt-4 space-y-4">
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

                        <!-- 応募ボタン -->
                        <div class="mt-6 flex justify-center space-x-3">
                            <Link 
                                href="/"
                                class="rounded bg-gray-500 hover:bg-gray-400 text-white text-base font-bold px-8 py-2"
                            >
                                戻る
                            </Link>
                            <button
                                type="button"
                                @click="showEntryModal = true"
                                class="rounded bg-blue-500 hover:bg-blue-400 text-white text-base font-bold px-8 py-2"
                            >
                                エントリー
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- エントリーモーダル -->
            <EntryModal
    :show="showEntryModal"
    :project-id="project.id"
    @close="showEntryModal = false"
/>
        </template>
    </AppLayout>
</template>