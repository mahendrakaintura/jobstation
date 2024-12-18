<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import UnregisterModal from '@/Components/User/UnregisterModal.vue';

const showUnregisterModal = ref(false)
</script>

<template>
    <Head title="退会" />
    <AppLayout>
        <template #main>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="max-w-2xl mx-auto bg-white rounded-md shadow-sm p-6">
                    <div class="mt-4 space-y-4 flex flex-col gap-5">
                        <h3>退会</h3>
                        <div class="mt-6 flex justify-center space-x-3">
                            退会する方は、下記の「退会する」ボタンをクリックする
                        </div>

                        <div class="mt-6 flex justify-center space-x-3">
                            <button
                                type="button"
                                @click="showUnregisterModal = true"
                                class="rounded bg-blue-500 hover:bg-blue-400 text-white text-base font-bold px-8 py-2"
                            >
                                退会する
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <UnregisterModal
                :show="showUnregisterModal"
                @close="showUnregisterModal = false"
            />
        </template>
    </AppLayout>
</template>