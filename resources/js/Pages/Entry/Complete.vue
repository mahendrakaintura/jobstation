<script setup>
import { Head } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
</script>

<template>
    <Head title="エントリー完了" />
    
    <AppLayout>
        <template #main>
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div class="px-4 py-6 sm:px-0">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 text-center">
                            <h1 class="text-2xl font-bold mb-4">エントリーが完了しました</h1>
                            <p class="mb-4">ご応募ありがとうございます。</p>
                            
                                <a href="/"
                                class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                            >
                                トップページへ戻る
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>